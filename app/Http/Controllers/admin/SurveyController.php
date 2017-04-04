<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\EmailTrait;
use App\Indicator;
use App\Participant;
use App\Role_User;
use App\Survey;
use App\Survey_Type;
use App\User;
use App\Company;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Response;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Worksheet;
use PDF;
use View;
use App;
use Users;


class SurveyController extends Controller { 
use EmailTrait;
    public function index(){
		$companyTimeZone = DB::table('company_profiles')->where('id',Auth::User()->company_id)->value('time_zone');
		$closed = DB::table('surveys')
							->select('surveys.id','surveys.user_id','surveys.type_id','surveys.company_id','surveys.category_id',
							'surveys.user_group_id','surveys.title','surveys.description','surveys.end_message','surveys.start_time',
							'surveys.end_time','surveys.created_at','surveys.updated_at')
							->where('surveys.company_id',Auth::User()->company_id)
							->where('surveys.user_id',Auth::User()->id)
							->where('surveys.start_time','<',Carbon::now($companyTimeZone))
							->where('surveys.end_time','<',Carbon::now($companyTimeZone))
							->where('surveys.category_id',1)->get();
        return view('survey.index')
					->with('closed',$closed);
    }

    /**
     * Show the form for creating a new survey.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('survey.create')->with('indicators',Indicator::all())
              ->with('participants',DB::table('users')
              ->join('role_user','role_user.user_id','=','users.id')
              ->join('companies','companies.id','=','users.company_id')
			  ->select('users.id', 'users.email', 'users.name')
              ->where('role_id','!=',0)
                     ->where('company_id','=',Auth::User()->company_id)
                     ->get());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
		dd($request);
		$companyTimeZone = DB::table('company_profiles')->where('id',Auth::User()->company_id)->value('time_zone');
		$numberOfBasicAndSpecialUsers = DB::select(DB::raw(
                                "select users.id from users 
									join role_user on users.id = role_user.user_id 
									where role_user.role_id != 1 
									and users.company_id = :companyId"),
                                array("companyId"=>Auth::User()->company_id));
		
		//dd($request->all());
        $validation=Validator::make($request->all(),[
            'title'=>'required|max:255',
            'editor1'=>'required|max:10000',
            'date'=>'required',
            'survey_type'=>'required',
            'editor2'=>'required|max:500'

        ]);
		
		if($request->survey_type == 2 && $request->numberOfEvaluators < 1){
			    return redirect()->back()
                    ->with('fail','You need to provide the number of evaluators for your peer survey: It cannot be zero')
                    ->withInput();
            }
			
		if($request->survey_type == 2 && $request->numberOfEvaluators == count($numberOfBasicAndSpecialUsers)){
			return redirect()->back()
				->with('fail','The number of evaluators for your peer survey cannot equal the number of participants in the survey')
				->withInput();
		}
		
		if($request->survey_type == 2 && $request->numberOfEvaluators > count($numberOfBasicAndSpecialUsers)){
			dd(count($numberOfBasicAndSpecialUsers));
			return redirect()->back()
				->with('fail','The number of evaluators for your peer survey cannot be greator than the number of participants in the survey')
				->withInput();
		}
		

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }else{
            $date=explode('-',$request->date);
            $from=new Carbon($date[0]);
            $to=new Carbon($date[1]);

            if($from<Carbon::now($companyTimeZone) || $to<Carbon::now($companyTimeZone)){
                return redirect()->back()
                    ->with('fail','The Survey open and close date should not be before the current date and time. Your Company Time Zone was set to: '.$companyTimeZone)
                    ->withInput();
            }else{
		DB::beginTransaction();
			try{
			$owner=Auth::User();
                $survey=$owner->creates_survey()->create([
                    'title'=>$request->title,
                    'description'=>$request->editor1,
					'number_of_evaluators'=>$request->numberOfEvaluators,
                    'end_message'=>$request->editor2,
                    'user_id'=>$owner->id,
                    'type_id'=>$request->survey_type,
                    'company_id'=>Auth::User()->company_id,
                    'category_id'=>1,
                    'start_time'=>$from,
                    'end_time'=>$to
                ]);

                $participants=DB::table('users')->where('company_id',Auth::User()->company_id)
                    ->join('role_user','role_user.user_id','=','users.id')
                    ->where('role_user.role_id','!=',0)
                    //->where('role_user.user_id','!=',Auth::User()->id)
                    ->select('users.id', 'email', 'external')->get();

                foreach($participants as $participant){
                    $survey->participants()->create([
                        'user_id'=>$participant->id
                    ]);
				if($participant->external == 0){
					//send email to the participants
					$this->email('email.newsurvey',['owner'=>$owner->name, 'link'=>url('/').'/login',
            	     'title'=>$survey->title,'name'=>User::find($participant->id)->name,'start_time'=>$from,'end_time'=>$to],$participant->email);
                }
				}

                /*foreach($participants as $participant){
                    $member_email[]=$participant->email;
                }

              //send email to the participants
              $this->email('email.newsurvey',['owner'=>$owner->name, 'link'=>url('/').'/login',
            	     'title'=>$survey->title, 'start_time'=>$from,'end_time'=>$to],$member_email);*/
			
			DB::commit();
				
                return Redirect::to('admin')->with('success','Your survey has been created successfully.
                 The survey will be open to the participants on the open date you have specified. Also, you can view the complete result of the survey once it is closed ');
				 
			}catch(\Exception $e){
				DB::rollback();
				return redirect()->back()
                    ->with('fail','An error occured; your request could not be completed '.$e->getMessage())
                    ->withInput();			
	    }
            }
            }

    }


	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	
	//This is because setting a global route to do this was giving inconsistencies when one would navigate from page to page
	public function switchLanguage(Request $request){
		return response()->json(array('stri'=>'success'));
	}
	 
	//Notes: Ajax does a post but knows nothing about rendering complex blades smoothly without using complex code
	//To achieve smooth redirection in a simple way you have to call a route in the ajax window.replace function
	//A sensible approach here would be to get post results, put them in private variables and then use them in a function
	//that serves the desired blade through a get route other than a post route
	//That approach failed as the variables were not available in the next function call
	//A new approach had to be adapted as below in other words post through ajax
	// and then parameter passing via routes

	public function lookForParticipant(Request $request){
		$participantId = $request['participantId'];
		$surveyId = $request['surveyId'];
		$newRoute = "getParticipant/";
		$newRoute .= $surveyId;
		$newRoute .= "/";
		$newRoute .= $participantId;
        return response()->json(array('stri'=>$newRoute,'strin'=>$participantId));
	}

	public function getParticipant($surveyId, $participantId){
		return $this->getParticipantDetails($surveyId, $participantId);
    }
	
	//This is the download pdf function: It could look that we should do a dedicated function since the queries look the same; but the problem is that we are dealing with an app that has dynamically
	//evolving requirements subject to change at any time: at one point they may look similar enough to be grouped into a clearly known function, but at another instance
	//they may change and you find yourself refactoring or rewriting to separate them out.
	public function downloadPdf($id){
	try{
	//dd($this->SurveyType($id));
		if ($this->SurveyType($id) == 'self') {
			$surveyScoreAllUsers = DB::table('indicators')
                                ->join('results','results.indicator_id','=','indicators.id')
                                ->join('indicator_groups','indicators.group_id','=','indicator_groups.id')
                                ->select('results.survey_id as Survey_ID',
                                         'results.user_id as User_ID','indicators.id as Indicator_ID',
                                         'indicators.indicator as Indicator', 'results.answer as Answer',
                                         'indicators.group_id as Indicator_Group_ID','indicator_groups.name as Indicator_Group')
                                ->where('results.survey_id',$id)
                                ->groupBy('results.survey_id','results.user_id', 'indicators.id')
                                ->get();


              //This returns the average of the user group per indicator in this survey
              $surveyGroupAveragePerIndicatorAllUsers = DB::select(DB::raw(
                                "SELECT results.survey_id as Survey_ID,
                                indicators.id as Indicator_ID, indicators.indicator as Indicator,
                                AVG(results.answer) as Group_Average
                                FROM indicators
                                join results on results.indicator_id = indicators.id
                                WHERE results.survey_id = :surveyId
                                GROUP BY results.survey_id, indicators.id"),
                                array("surveyId"=>$id));

              //This returns the average of each user per indicator group for this survey
              $surveyScoreGroupAvgPerIndicatorGroup = DB::select(DB::raw(
                                "SELECT results.survey_id as Survey_ID,
                                results.user_id as User_ID, indicators.group_id as Indicator_Group_ID,
                                indicator_groups.name as Indicator_Group,
                                AVG(results.answer) as Indicator_Group_Average
                                FROM indicators
                                JOIN results on results.indicator_id = indicators.id
                                JOIN indicator_groups on indicators.group_id = indicator_groups.id
                                WHERE results.survey_id = :surveyId
                                GROUP BY results.survey_id, results.user_id, indicators.group_id"),
                                array("surveyId"=>$id));

              //This returns the average of each user group per indicator group in this survey
              $surveyScorePerIndicatorGroup = DB::select(DB::raw(
                                "SELECT results.survey_id as Survey_ID,
                                indicators.group_id as Indicator_Group_ID,
                                indicator_groups.name as Indicator_Group,
                                AVG(results.answer) as Indicator_Group_Average
                                FROM indicators
                                JOIN results on results.indicator_id = indicators.id
                                JOIN indicator_groups on indicators.group_id = indicator_groups.id
                                WHERE results.survey_id = :surveyId
                                GROUP BY results.survey_id, indicators.group_id"),
                                array("surveyId"=>$id));
								
								
			  //This returns the average of each user group per indicator group in this survey
              $surveyScoreGroupAvgPerIndicatorGroupMinAndMax = DB::select(DB::raw(
                                "SELECT p.Survey_ID, p.Indicator_Group_ID, p.Indicator_Group,
									MIN(p.Indicator_Group_Average) as Minimum_User_Indicator_Group_Average ,
									MAX(p.Indicator_Group_Average) as Maximum_User_Indicator_Group_Average FROM
										(SELECT results.survey_id as Survey_ID, results.user_id as User_ID, indicators.group_id as Indicator_Group_ID,
											indicator_groups.name as Indicator_Group,
											AVG(results.answer) as Indicator_Group_Average
											FROM indicators
											JOIN results on results.indicator_id = indicators.id
											JOIN indicator_groups on indicators.group_id = indicator_groups.id
											WHERE results.survey_id = :surveyId
											GROUP BY results.survey_id, results.user_id, indicators.group_id)
								AS p GROUP BY p.Indicator_Group_ID"),
                                array("surveyId"=>$id));


				$company=Auth::User()->company()->first();
				$company_profile=$company->profile()->first();
				$survey = Survey::find($id);
				$participants = Survey::find($id)->participants;
				$answers = count(Survey::find($id)->participants()->where('completed',1)->get());
				
				//This check tests if you have the required data to generate the pdf: You can delete the checks that do not affect your data
				if(empty($surveyScoreAllUsers)){
					return redirect()->back()
                    ->with('fail','PDF could not be generated because some of the required results were null ')
                    ->withInput();
				}
				
				$view = View::make('survey.resultForAdminPdfOverView',compact('survey','surveyScoreAllUsers','surveyGroupAveragePerIndicatorAllUsers',
									'surveyScorePerIndicatorGroup','surveyScoreGroupAvgPerIndicatorGroup','surveyScoreGroupAvgPerIndicatorGroupMinAndMax',
									'participants','company','company_profile','answers'))->render();
				$pdf = App::make('snappy.pdf.wrapper');
				$pdf->setOption('enable-javascript', true);
				$pdf->setOption('javascript-delay', 5000);
				$pdf->setOption('enable-smart-shrinking', true);
				$pdf->setOption('no-stop-slow-scripts', true);
				$pdf->loadHTML($view);
				return $pdf->inline();
			  				
		}
		
		if ($this->SurveyType($id) == 'peer') {
						
							$surveyScoreAllUsersCheckThreeParticipants = DB::select(DB::raw(
												"select p.user_id from (select peer_results.id, peer_results.peer_survey_id, 
												peer_results.user_id, peer_results.indicator_id, count(peer_results.peer_id) 
												from `peer_results` where peer_results.peer_survey_id = :surveyId group by 
												peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id 
												having count(peer_results.peer_id)>1) as p group by p.user_id"),
                                              array("surveyId"=>$id));
			
							$surveyScoreAllUsers = DB::select(DB::raw(
												"select peer_results.id, peer_results.peer_survey_id as Survey_ID, peer_results.user_id as User_ID, 
												 peer_results.indicator_id as Indicator_ID, indicators.indicator as Indicator, indicators.group_id as Indicator_Group_ID, 
												 indicator_groups.name as Indicator_Group, avg(peer_results.answer) as Answer from `peer_results`
												 join indicators on indicators.id = peer_results.indicator_id
												 join indicator_groups on indicator_groups.id = indicators.group_id
												 where peer_results.peer_survey_id = :surveyId group by 
												 peer_results.peer_survey_id, peer_results.user_id, 
												 peer_results.indicator_id having count(peer_results.peer_id)>1"),
												array("surveyId"=>$id));


                            //This returns the average of the user group per indicator in this survey
                            $surveyGroupAveragePerIndicatorAllUsers = DB::select(DB::raw(
                                              "select p.id, p.peer_survey_id as Survey_ID, p.indicator_id as Indicator_ID, p.indicator as Indicator, avg(p.Group_Average) as Group_Average from 
											  (select peer_results.id, peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id, 
											  indicators.indicator, indicators.group_id, indicator_groups.name, avg(peer_results.answer) as Group_Average 
											  from `peer_results`
											  join indicators on indicators.id = peer_results.indicator_id
											  join indicator_groups on indicator_groups.id = indicators.group_id
											  where peer_results.peer_survey_id = :surveyId group by 
											  peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id 
											  having count(peer_results.peer_id)>1) as p group by p.peer_survey_id, p.indicator_id"),
                                              array("surveyId"=>$id));

                            //This returns the average of each user per indicator group for this survey
                            $surveyScoreGroupAvgPerIndicatorGroup = DB::select(DB::raw(
                                              "select p.id, p.peer_survey_id as Survey_ID, p.user_id as User_ID, p.group_id as Indicator_Group_ID, p.name as Indicator_Group, avg(p.Indicator_Group_Average) as Indicator_Group_Average from 
											  (select peer_results.id, peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id, 
											  indicators.indicator, indicators.group_id, indicator_groups.name, avg(peer_results.answer) as Indicator_Group_Average 
											  from `peer_results`
											  join indicators on indicators.id = peer_results.indicator_id
											  join indicator_groups on indicator_groups.id = indicators.group_id
											  where peer_results.peer_survey_id = :surveyId group by 
											  peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id 
											  having count(peer_results.peer_id)>1) as p group by p.peer_survey_id, p.user_id, p.group_id"),
                                              array("surveyId"=>$id));

                            //This returns the average of each user group per indicator group in this survey
                            $surveyScorePerIndicatorGroup = DB::select(DB::raw(
                                              "select p.id, p.peer_survey_id as Survey_ID, p.group_id as Indicator_Group_ID, p.name as Indicator_Group, avg(p.Indicator_Group_Average) as Indicator_Group_Average from 
											  (select peer_results.id, peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id, 
											  indicators.indicator, indicators.group_id, indicator_groups.name, avg(peer_results.answer) as Indicator_Group_Average 
											  from `peer_results`
											  join indicators on indicators.id = peer_results.indicator_id
											  join indicator_groups on indicator_groups.id = indicators.group_id
											  where peer_results.peer_survey_id = :surveyId group by 
											  peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id 
											  having count(peer_results.peer_id)>1) as p group by p.peer_survey_id, p.group_id"),
                                              array("surveyId"=>$id));
							
							$company=Auth::User()->company()->first();
							$company_profile=$company->profile()->first();
							
							
							//This returns the minimum and maximum average per indicator group in this survey
							$surveyScoreGroupAvgPerIndicatorGroupMinAndMax = DB::select(DB::raw(
                                "SELECT d.Survey_ID, d.Indicator_Group_ID, d.Indicator_Group,
									MIN(d.Indicator_Group_Average) as Minimum_User_Indicator_Group_Average ,
									MAX(d.Indicator_Group_Average) as Maximum_User_Indicator_Group_Average FROM
										(select p.id, p.peer_survey_id as Survey_ID, p.user_id as User_ID, p.group_id as Indicator_Group_ID, p.name as Indicator_Group, avg(p.Indicator_Group_Average) as Indicator_Group_Average from 
											  (select peer_results.id, peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id, 
											  indicators.indicator, indicators.group_id, indicator_groups.name, avg(peer_results.answer) as Indicator_Group_Average 
											  from `peer_results`
											  join indicators on indicators.id = peer_results.indicator_id
											  join indicator_groups on indicator_groups.id = indicators.group_id
											  where peer_results.peer_survey_id = :surveyId group by 
											  peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id 
											  having count(peer_results.peer_id)>1) as p group by p.peer_survey_id, p.user_id, p.group_id)
								AS d GROUP BY d.Indicator_Group_ID"),
                                array("surveyId"=>$id));
							
							
							$answers = DB::select(DB::raw(
									"select users.id, users.name, users.email from users where users.id in
										(select p.user_id from (select peer_results.id, peer_results.peer_survey_id, 
												peer_results.user_id, peer_results.indicator_id, count(peer_results.peer_id) 
												from `peer_results` where peer_results.peer_survey_id = :surveyId group by 
												peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id 
												having count(peer_results.peer_id)>1) as p group by p.user_id)"),
											array("surveyId"=>$id));
					
					
				$company=Auth::User()->company()->first();
				$company_profile=$company->profile()->first();
				$survey = Survey::find($id);
				$participants = Survey::find($id)->participants;
				$answers = count($answers);
				
				//This check tests if you have the required data to generate the pdf: You can delete the checks that do not affect your data
				if(empty($surveyScoreAllUsers)){
					return redirect()->back()
                    ->with('fail','PDF could not be generated because some of the required results were null ')
                    ->withInput();
				}
				
				$view = PDF::loadView('survey.resultForAdminPdfOverView',
										compact('survey','$surveyScoreAllUsersCheckThreeParticipants','surveyScoreAllUsers',
											'surveyGroupAveragePerIndicatorAllUsers','surveyScorePerIndicatorGroup',
											'surveyScoreGroupAvgPerIndicatorGroup','surveyScoreGroupAvgPerIndicatorGroupMinAndMax',
											'participants','company','company_profile','answers'));
				//$pdf = \App::make('dompdf.wrapper');
				//$pdf->loadHTML($view);
				$view->setOption('enable-javascript',true);
				$view->setOption('javascript-delay',13500);
				$view->setOption('enable-smart-shrinking',true);
				$view->setOption('no-stop-slow-scripts',true);
				return $view->inline();
		}
		
		return redirect()->back();
		}catch(\Exception $e){
				return redirect()->back()
                    ->with('fail','An error occured; your request could not be completed '.$e->getMessage())
                    ->withInput();			
	    }
				
	}

	//Tight coupling the seemingly similar queries or functions may look feasible at first sight, but remember they cater for different situations and functionality which may 
	//dynamically change: abstract class implementations in laravel may possibly be okay but we opted for a self contained implementation
	//Also another assumption has been made that an unbuffered query of say 500 to 2000 records can be easily processed by the available server resources within a loop
	//The practical aspect of survey respondents being more than 500 to 2000 participants is unlikely yet even in the case of 10,000 respondents,
	// the server should be able to handle that. if we are talking bigger respondents than that here, then a new design approach 
	//May have to be looked into.
	public function downloadCsv($surveyId){
		$id = $surveyId;
		if($this->ValidateSurvey($id)=='true'){
          if($this->SurveyStatus($id)=='pending'){
              $this->editSurvey($id);
          }else{
              //This returns the indicator scores for each user that took part in the survey
              //Used native or raw queries because laravel has no support for listed grouping on aggregate functions
              //In other words it will always return a single result
			  //This returns the average of each user group per indicator group in this survey
              $surveyScoreGroupAvgPerIndicatorGroupMinAndMax = DB::select(DB::raw(
                                "SELECT p.Survey_ID, p.Indicator_Group_ID, p.Indicator_Group,
									MIN(p.Indicator_Group_Average) as Minimum_User_Indicator_Group_Average ,
									MAX(p.Indicator_Group_Average) as Maximum_User_Indicator_Group_Average FROM
										(SELECT results.survey_id as Survey_ID, results.user_id as User_ID, indicators.group_id as Indicator_Group_ID,
											indicator_groups.name as Indicator_Group,
											AVG(results.answer) as Indicator_Group_Average
											FROM indicators
											JOIN results on results.indicator_id = indicators.id
											JOIN indicator_groups on indicators.group_id = indicator_groups.id
											WHERE results.survey_id = :surveyId
											GROUP BY results.survey_id, results.user_id, indicators.group_id)
								AS p GROUP BY p.Indicator_Group_ID"),
                                array("surveyId"=>$id));
			  
              $surveyScoreAllUsers = DB::table('indicators')
                                ->join('results','results.indicator_id','=','indicators.id')
                                ->join('indicator_groups','indicators.group_id','=','indicator_groups.id')
                                ->select('results.survey_id as Survey_ID',
                                         'results.user_id as User_ID','indicators.id as Indicator_ID',
                                         'indicators.indicator as Indicator', 'results.answer as Answer'
                                         )
                                ->where('results.survey_id',$id)
                                ->groupBy('results.survey_id','results.user_id', 'indicators.id')
                                ->get();
								
			   $participants = DB::table('participants')
                                ->join('users','users.id','=','participants.user_id')
                                ->select('users.id as User_ID',
                                         'users.name as Name','users.email as Email',
                                         'participants.completed as Completed'
                                         )
                                ->where('participants.survey_id',$id)
                                ->groupBy('participants.survey_id','participants.user_id')
                                ->get();
								
				$surveys = DB::table('surveys')
                                ->select('surveys.id as Survey_ID',
                                         'surveys.title as Title','surveys.description as Description',
                                         'surveys.start_time as Start_Time','surveys.end_time as End_Time'
                                         )
                                ->where('surveys.id',$id)
                                ->get();

              $company = Auth::User()->company()->first();
			  $company_profile=$company->profile()->first();
			  $participantsNumber = count(Survey::find($id)->participants()->get());
			  $participantsCompletedNumber = count(Survey::find($id)->participants()->where('completed',1)->get());
			  
			  //These are the peer survey variables: the application is an evolving one with changes crafted in from time to time: reorganizing the code to have pre defined functions
			  //as any programmer would think of the code below, would mean doing so so many times as unanticipated changes arise: better to have the loose coupling and allow for future
			  //growth
			  $surveyScoreGroupAvgPerIndicatorGroupMinAndMaxPeer = DB::select(DB::raw(
                                "SELECT d.Survey_ID, d.Indicator_Group_ID, d.Indicator_Group,
									MIN(d.Indicator_Group_Average) as Minimum_User_Indicator_Group_Average ,
									MAX(d.Indicator_Group_Average) as Maximum_User_Indicator_Group_Average FROM
										(select p.id, p.peer_survey_id as Survey_ID, p.user_id as User_ID, p.group_id as Indicator_Group_ID, p.name as Indicator_Group, avg(p.Indicator_Group_Average) as Indicator_Group_Average from 
											  (select peer_results.id, peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id, 
											  indicators.indicator, indicators.group_id, indicator_groups.name, avg(peer_results.answer) as Indicator_Group_Average 
											  from `peer_results`
											  join indicators on indicators.id = peer_results.indicator_id
											  join indicator_groups on indicator_groups.id = indicators.group_id
											  where peer_results.peer_survey_id = :surveyId group by 
											  peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id 
											  having count(peer_results.peer_id)>1) as p group by p.peer_survey_id, p.user_id, p.group_id)
								AS d GROUP BY d.Indicator_Group_ID"),
                                array("surveyId"=>$id));
				
				
               $surveyScoreAllUsersPeer = DB::select(DB::raw(
												"select peer_results.peer_survey_id as Survey_ID, peer_results.user_id as User_ID, 
												 peer_results.indicator_id as Indicator_ID, indicators.indicator as Indicator,
												 avg(peer_results.answer) as Answer from `peer_results`
												 join indicators on indicators.id = peer_results.indicator_id
												 join indicator_groups on indicator_groups.id = indicators.group_id
												 where peer_results.peer_survey_id = :surveyId group by 
												 peer_results.peer_survey_id, peer_results.user_id, 
												 peer_results.indicator_id having count(peer_results.peer_id)>1"),
												array("surveyId"=>$id));
								
			  $headers = array(
					'Content-Type' 	=> 'application/vnd.ms-excel',
					'Content-Disposition'	=>	'attachment;filename="dav.xlsx"'
				);
				
			  $workBook = new PHPExcel();
			  $workSheet1 = new PHPExcel_Worksheet($workBook, 'Survey');
			  $workBook->addSheet($workSheet1,0);
			  $workSheet2 = new PHPExcel_Worksheet($workBook, 'Participants');
			  $workBook->addSheet($workSheet2,1);
			  $workSheet3 = new PHPExcel_Worksheet($workBook, 'Results');
			  $workBook->addSheet($workSheet3,2);
			  $workSheet4 = new PHPExcel_Worksheet($workBook, 'Min_Max_Average');
			  $workBook->addSheet($workSheet4,3);
			  
			  //Write the survey details to the excel sheet
			  $surveyArray = array();
			  $surveyArray[] = ['Survey_ID','Title','Description','Start_Time','End_Time'
                                         ];
			  foreach ($surveys as $survey){
				  $surveyArray[] = get_object_vars($survey);
			  }
			  $workBook->getSheet(0)->fromArray(
					$surveyArray,
					NULL,
					'A1'
			  );
			  
			  
			  //Write the participants to the excel sheet
			  $surveyParticipantsArray = array();
			  $surveyParticipantsArray[] = ['User_ID','Name','Email','Completed'
                                         ];
			  foreach ($participants as $participant){
				  $surveyParticipantsArray[] = get_object_vars($participant);
			  }
			  $workBook->getSheet(1)->fromArray(
					$surveyParticipantsArray,
					NULL,
					'A1'
			  );
			  
			  //Write the results to the excel sheet
			  $surveyScoreAllUsersArray = array();
			  $surveyScoreAllUsersArray[] = ['Survey_ID','User_ID','Indicator_ID',
                                         'Indicator', 'Answer'
                                         ];
			 if ($this->SurveyType($id) == 'self') {
			  foreach ($surveyScoreAllUsers as $surveyScoreAllUser){
				  $surveyScoreAllUsersArray[] = get_object_vars($surveyScoreAllUser);
			  }
			 }
			 if ($this->SurveyType($id) == 'peer') {
			  foreach ($surveyScoreAllUsersPeer as $surveyScoreAllUser){
				  $surveyScoreAllUsersArray[] = get_object_vars($surveyScoreAllUser);
			  }
			 }
			  $workBook->getSheet(2)->fromArray(
					$surveyScoreAllUsersArray,
					NULL,
					'A1'
			  );
			  
			  //Write the min and maximum to the excel sheet
			  $surveyScoreMinMaxArray = array();
			  $surveyScoreMinMaxArray[] = ['Survey_ID','Indicator_Group_ID','Indicator_Group',
                                         'Minimum_User_Indicator_Group_Average', 'Maximum_User_Indicator_Group_Average'
                                         ];
			if ($this->SurveyType($id) == 'self') {
			  foreach ($surveyScoreGroupAvgPerIndicatorGroupMinAndMax as $surveyScoreAllUser){
				  $surveyScoreMinMaxArray[] = get_object_vars($surveyScoreAllUser);
			  }
			}
			if ($this->SurveyType($id) == 'peer') {
			  foreach ($surveyScoreGroupAvgPerIndicatorGroupMinAndMaxPeer as $surveyScoreAllUser){
				  $surveyScoreMinMaxArray[] = get_object_vars($surveyScoreAllUser);
			  }
			}
			  $workBook->getSheet(3)->fromArray(
					$surveyScoreMinMaxArray,
					NULL,
					'A1'
			  );
			  
			  //Get a php object writer coz we want to write objects to file
			  $objectWriter = PHPExcel_IOFactory::createWriter($workBook,'Excel2007');
			  ob_end_clean();
			  
			  //Provide a callback to be used by the response stream
			  $callback = function() use($objectWriter){
				  //Write the objects to a php output
				  $objectWriter->save('php://output');
			  };
			  //return the stream
			  return response()->stream($callback, 200, $headers);
			  
          }

      }else{
          return view('errors.404')->with('title',' Survey Not found')
              ->with('message','The survey you requested doe not belong to your company or does not exists in the Fincoda Survey System.');
      }
    }
	
	
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
	  	
      if($this->ValidateSurvey($id)=='true'){
          if($this->SurveyStatus($id)=='pending'){
              $this->editSurvey($id);
          }else{
			  if ($this->SurveyType($id) == 'self') {
              //This returns the indicator scores for each user that took part in the survey
              //Used native or raw queries because laravel has no support for listed grouping on aggregate functions
              //In other words it will always return a single result
              $surveyScoreAllUsers = DB::table('indicators')
                                ->join('results','results.indicator_id','=','indicators.id')
                                ->join('indicator_groups','indicators.group_id','=','indicator_groups.id')
                                ->select('results.survey_id as Survey_ID',
                                         'results.user_id as User_ID','indicators.id as Indicator_ID',
                                         'indicators.indicator as Indicator', 'results.answer as Answer',
                                         'indicators.group_id as Indicator_Group_ID','indicator_groups.name as Indicator_Group')
                                ->where('results.survey_id',$id)
                                ->groupBy('results.survey_id','results.user_id', 'indicators.id')
                                ->get();


              //This returns the average of the user group per indicator in this survey
              $surveyGroupAveragePerIndicatorAllUsers = DB::select(DB::raw(
                                "SELECT results.survey_id as Survey_ID,
                                indicators.id as Indicator_ID, indicators.indicator as Indicator,
                                AVG(results.answer) as Group_Average
                                FROM indicators
                                join results on results.indicator_id = indicators.id
                                WHERE results.survey_id = :surveyId
                                GROUP BY results.survey_id, indicators.id"),
                                array("surveyId"=>$id));

              //This returns the average of each user per indicator group for this survey
              $surveyScoreGroupAvgPerIndicatorGroup = DB::select(DB::raw(
                                "SELECT results.survey_id as Survey_ID,
                                results.user_id as User_ID, indicators.group_id as Indicator_Group_ID,
                                indicator_groups.name as Indicator_Group,
                                AVG(results.answer) as Indicator_Group_Average
                                FROM indicators
                                JOIN results on results.indicator_id = indicators.id
                                JOIN indicator_groups on indicators.group_id = indicator_groups.id
                                WHERE results.survey_id = :surveyId
                                GROUP BY results.survey_id, results.user_id, indicators.group_id"),
                                array("surveyId"=>$id));

              //This returns the average of each user group per indicator group in this survey
              $surveyScorePerIndicatorGroup = DB::select(DB::raw(
                                "SELECT results.survey_id as Survey_ID,
                                indicators.group_id as Indicator_Group_ID,
                                indicator_groups.name as Indicator_Group,
                                AVG(results.answer) as Indicator_Group_Average
                                FROM indicators
                                JOIN results on results.indicator_id = indicators.id
                                JOIN indicator_groups on indicators.group_id = indicator_groups.id
                                WHERE results.survey_id = :surveyId
                                GROUP BY results.survey_id, indicators.group_id"),
                                array("surveyId"=>$id));

				//This selects the indicators on which the participant scored minimum values: the query becomes complex because of the possibility of
				//different indicators having the same minimum value
			  $surveyScoreAllUsersMinimum = DB::select(DB::raw("SELECT k.Surveys_ID, k.Users_ID, d.Indicator_ID, d.Indicator, k.Minimum_Answer
								FROM (select results.survey_id as Survey_ID, results.user_id as User_ID, indicators.id as Indicator_ID,
										indicators.indicator as Indicator, results.answer as Answer, indicators.group_id as Indicator_Group_ID,
										indicator_groups.name as Indicator_Group FROM indicators
										JOIN results on results.indicator_id = indicators.id
										JOIN indicator_groups on indicators.group_id = indicator_groups.id
										WHERE results.survey_id = :surveyId1
										GROUP BY results.survey_id, results.user_id, indicators.id)
								as d
								JOIN (SELECT Min_Answer.Survey_ID as Surveys_ID, Min_Answer.User_ID as Users_ID, MIN(Min_Answer.Answer) as Minimum_Answer
										FROM (select results.survey_id as Survey_ID, results.user_id as User_ID,
											  indicators.id as Indicator_ID, indicators.indicator as Indicator,
											  results.answer as Answer, indicators.group_id as Indicator_Group_ID,
											  indicator_groups.name as Indicator_Group FROM indicators
											  JOIN results on results.indicator_id = indicators.id
											  JOIN indicator_groups on indicators.group_id = indicator_groups.id
											  WHERE results.survey_id = :surveyId2
											  GROUP BY results.survey_id, results.user_id, indicators.id)
										as Min_Answer
										GROUP by Min_Answer.Survey_ID, Min_Answer.User_ID)
								as k on d.Survey_ID = k.Surveys_ID
								WHERE d.Answer = k.Minimum_Answer
								GROUP BY k.Surveys_ID, k.Users_ID, d.Indicator_ID"),
                                array("surveyId1"=>$id,"surveyId2"=>$id));

				//This selects the indicators on which the participant scored maximum values: the query becomes complex because of the possibility of
				//different indicators having the same maximum value
			  $surveyScoreAllUsersMaximum = DB::select(DB::raw("SELECT k.Surveys_ID, k.Users_ID, d.Indicator_ID, d.Indicator, k.Maximum_Answer
								FROM (select results.survey_id as Survey_ID, results.user_id as User_ID, indicators.id as Indicator_ID,
										indicators.indicator as Indicator, results.answer as Answer, indicators.group_id as Indicator_Group_ID,
										indicator_groups.name as Indicator_Group FROM indicators JOIN results on results.indicator_id = indicators.id
										JOIN indicator_groups on indicators.group_id = indicator_groups.id WHERE results.survey_id = :surveyId1
										GROUP BY results.survey_id, results.user_id, indicators.id) as d
								JOIN (SELECT Max_Answer.Survey_ID as Surveys_ID, Max_Answer.User_ID as Users_ID, MAX(Max_Answer.Answer) as Maximum_Answer
											FROM (select results.survey_id as Survey_ID, results.user_id as User_ID, indicators.id as Indicator_ID,
													indicators.indicator as Indicator, results.answer as Answer, indicators.group_id as Indicator_Group_ID,
													indicator_groups.name as Indicator_Group FROM indicators
													JOIN results on results.indicator_id = indicators.id
													JOIN indicator_groups on indicators.group_id = indicator_groups.id
													WHERE results.survey_id = :surveyId2
													GROUP BY results.survey_id, results.user_id, indicators.id) as Max_Answer
											GROUP by Max_Answer.Survey_ID, Max_Answer.User_ID)
								as k on d.Survey_ID = k.Surveys_ID
								WHERE d.Answer = k.Maximum_Answer
								GROUP BY k.Surveys_ID, k.Users_ID, d.Indicator_ID"),
                                array("surveyId1"=>$id,"surveyId2"=>$id));


			  //This selects the indicators on which the participant scored minimum averages: the query becomes complex because of the possibility of
				//different indicators having the same minimum value
			  $surveyGroupAveragePerIndicatorAllUsersMinimum = DB::select(DB::raw("SELECT k.Surveys_ID, d.Indicator_ID, d.Indicator, k.Minimum_Average FROM
										(SELECT results.survey_id as Survey_ID,
                                              indicators.id as Indicator_ID, indicators.indicator as Indicator,
                                              ROUND (AVG(results.answer), 2) as Group_Average
                                              FROM indicators
                                              JOIN results on results.indicator_id = indicators.id
                                              WHERE results.survey_id = :surveyId1
                                              GROUP BY results.survey_id, indicators.id)
										as d
                                        JOIN (SELECT Min_Average.Survey_ID as Surveys_ID, MIN(Min_Average.Group_Average) as Minimum_Average
												FROM (SELECT results.survey_id as Survey_ID,
													indicators.id as Indicator_ID, indicators.indicator as Indicator,
													ROUND (AVG(results.answer),2) AS Group_Average
													FROM indicators
													JOIN results on results.indicator_id = indicators.id
													WHERE results.survey_id = :surveyId2
													GROUP BY results.survey_id, indicators.id)
												AS Min_Average GROUP by Min_Average.Survey_ID)
										AS k on d.Survey_ID = k.Surveys_ID
                                        WHERE d.Group_Average = k.Minimum_Average
                                        GROUP BY k.Surveys_ID, d.Indicator_ID"),
                                array("surveyId1"=>$id,"surveyId2"=>$id));


				//This selects the indicators on which the participant scored maximum averages: the query becomes complex because of the possibility of
				//different indicators having the same maximum value
			  $surveyGroupAveragePerIndicatorAllUsersMaximum = DB::select(DB::raw("SELECT k.Surveys_ID, d.Indicator_ID, d.Indicator, k.Maximum_Average
										FROM (SELECT results.survey_id as Survey_ID, indicators.id as Indicator_ID, indicators.indicator as Indicator,
                                              ROUND (AVG(results.answer), 2) as Group_Average
                                              FROM indicators
                                              JOIN results on results.indicator_id = indicators.id
                                              WHERE results.survey_id = :surveyId1
                                              GROUP BY results.survey_id, indicators.id) as d
                                        JOIN (SELECT Max_Average.Survey_ID as Surveys_ID, MAX(Max_Average.Group_Average) as Maximum_Average
												FROM (SELECT results.survey_id as Survey_ID,
														indicators.id as Indicator_ID, indicators.indicator as Indicator,
														ROUND (AVG(results.answer),2) AS Group_Average
														FROM indicators
														JOIN results on results.indicator_id = indicators.id
														WHERE results.survey_id = :surveyId2
														GROUP BY results.survey_id, indicators.id) AS Max_Average
												GROUP by Max_Average.Survey_ID)
											  AS k on d.Survey_ID = k.Surveys_ID
                                        WHERE d.Group_Average = k.Maximum_Average
                                        GROUP BY k.Surveys_ID, d.Indicator"),
                                array("surveyId1"=>$id,"surveyId2"=>$id));


					//This selects the indicator groups on which the participant scored minimum averages: the query becomes complex because of the possibility of
				//different indicator groups having the same value
			  $surveyScoreGroupAvgPerIndicatorGroupMinimum = DB::select(DB::raw("SELECT k.Surveys_ID, k.Users_ID, d.Indicator_Group_ID, d.Indicator_Group, k.Minimum_Indicator_Group_Average
												FROM (SELECT results.survey_id as Survey_ID, results.user_id as User_ID, indicators.group_id as Indicator_Group_ID,
															indicator_groups.name as Indicator_Group, ROUND(AVG(results.answer), 2) as Indicator_Group_Average FROM indicators
															JOIN results on results.indicator_id = indicators.id
															JOIN indicator_groups on indicators.group_id = indicator_groups.id
															WHERE results.survey_id = :surveyId1
															GROUP BY results.survey_id, results.user_id, indicators.group_id)
												AS d
                                                JOIN (SELECT Min_Indicator_Group_Average.Survey_ID as Surveys_ID,
															Min_Indicator_Group_Average.User_ID as Users_ID,
															MIN(Min_Indicator_Group_Average.Indicator_Group_Average) as Minimum_Indicator_Group_Average
															FROM (SELECT results.survey_id as Survey_ID, results.user_id as User_ID, indicators.group_id as Indicator_Group_ID,
																	indicator_groups.name as Indicator_Group, ROUND(AVG(results.answer), 2) as Indicator_Group_Average
																	FROM indicators
																	JOIN results on results.indicator_id = indicators.id
																	JOIN indicator_groups on indicators.group_id = indicator_groups.id
																	WHERE results.survey_id = :surveyId2
																	GROUP BY results.survey_id, results.user_id, indicators.group_id)
																  AS Min_Indicator_Group_Average
															GROUP BY Min_Indicator_Group_Average.Survey_ID, Min_Indicator_Group_Average.User_ID)
												AS k
                                                ON d.Survey_ID = k.Surveys_ID
                                                WHERE d.Indicator_Group_Average = k.Minimum_Indicator_Group_Average
                                                GROUP BY k.Surveys_ID, k.Users_ID"),
                                array("surveyId1"=>$id,"surveyId2"=>$id));


				//This selects the indicator groups on which the participant scored maximum averages: the query becomes complex because of the possibility of
				//different indicator groups having the same value
			  $surveyScoreGroupAvgPerIndicatorGroupMaximum = DB::select(DB::raw("SELECT k.Surveys_ID, k.Users_ID, d.Indicator_Group_ID, d.Indicator_Group, k.Maximum_Indicator_Group_Average
                            	FROM (SELECT results.survey_id as Survey_ID, results.user_id as User_ID, indicators.group_id as Indicator_Group_ID, indicator_groups.name as Indicator_Group, 																ROUND(AVG(results.answer), 2) as Indicator_Group_Average FROM indicators
                                      	JOIN results on results.indicator_id = indicators.id
                                      	JOIN indicator_groups on indicators.group_id = indicator_groups.id
                                      	WHERE results.survey_id = :surveyId1
                                      	GROUP BY results.survey_id, results.user_id, indicators.group_id)
                                      AS d
                                 JOIN (SELECT Max_Indicator_Group_Average.Survey_ID as Surveys_ID, Max_Indicator_Group_Average.User_ID as Users_ID,
                                       MAX(Max_Indicator_Group_Average.Indicator_Group_Average) as Maximum_Indicator_Group_Average
                                            		FROM (SELECT results.survey_id as Survey_ID, results.user_id as User_ID, indicators.group_id as Indicator_Group_ID,
                                              					indicator_groups.name as Indicator_Group, ROUND(AVG(results.answer), 2) as Indicator_Group_Average
                                              					FROM indicators
                                              					JOIN results on results.indicator_id = indicators.id
                                              					JOIN indicator_groups on indicators.group_id = indicator_groups.id
                                                    			WHERE results.survey_id = :surveyId2
                                              					GROUP BY results.survey_id, results.user_id, indicators.group_id)
                                       AS Max_Indicator_Group_Average
                                       GROUP BY Max_Indicator_Group_Average.Survey_ID, Max_Indicator_Group_Average.User_ID)
                                  AS k on d.Survey_ID = k.Surveys_ID
                                  WHERE d.Indicator_Group_Average = k.Maximum_Indicator_Group_Average
                                  GROUP BY k.Surveys_ID, k.Users_ID"),
                                array("surveyId1"=>$id,"surveyId2"=>$id));


				//This selects the indicator groups on which all the participants scored minimum averages: the query becomes complex because of the possibility of
				//different indicator groups having the same value
			  $surveyScorePerIndicatorGroupMinimum = DB::select(DB::raw("SELECT k.Surveys_ID, d.Indicator_Group_ID, d.Indicator_Group, k.Minimum_Company_Indicator_Group_Average
						FROM (SELECT results.survey_id as Survey_ID,
                                indicators.group_id as Indicator_Group_ID,
                                indicator_groups.name as Indicator_Group,
                                AVG(results.answer) as Indicator_Group_Average
                                FROM indicators
                                JOIN results on results.indicator_id = indicators.id
                                JOIN indicator_groups on indicators.group_id = indicator_groups.id
								WHERE results.survey_id = :surveyId1
                                GROUP BY results.survey_id, indicators.group_id)
                              AS d
						JOIN (SELECT Min_Company_Indicator_Group_Average.Survey_ID as Surveys_ID,
								MIN(Min_Company_Indicator_Group_Average.Indicator_Group_Average) as Minimum_Company_Indicator_Group_Average
                                	FROM(SELECT results.survey_id as Survey_ID,
                                		indicators.group_id as Indicator_Group_ID,
                                		indicator_groups.name as Indicator_Group,
                                		AVG(results.answer) as Indicator_Group_Average
                                		FROM indicators
                                		JOIN results on results.indicator_id = indicators.id
                                		JOIN indicator_groups on indicators.group_id = indicator_groups.id
                                		WHERE results.survey_id = :surveyId2
                                      	GROUP BY results.survey_id, indicators.group_id) AS Min_Company_Indicator_Group_Average
                                		GROUP BY Min_Company_Indicator_Group_Average.Survey_ID)
                          AS k ON d.Survey_ID = k.Surveys_ID
                          WHERE d.Indicator_Group_Average = k.Minimum_Company_Indicator_Group_Average
                          GROUP BY k.Surveys_ID"),
                                array("surveyId1"=>$id,"surveyId2"=>$id));


				//This selects the indicator groups on which all the participants scored maximum averages: the query becomes complex because of the possibility of
				//different indicator groups having the same value
			  $surveyScorePerIndicatorGroupMaximum = DB::select(DB::raw("SELECT k.Surveys_ID, d.Indicator_Group_ID, d.Indicator_Group, k.Maximum_Company_Indicator_Group_Average FROM
						(SELECT results.survey_id as Survey_ID,
                                indicators.group_id as Indicator_Group_ID,
                                indicator_groups.name as Indicator_Group,
                                AVG(results.answer) as Indicator_Group_Average
                                FROM indicators
                                JOIN results on results.indicator_id = indicators.id
                                JOIN indicator_groups on indicators.group_id = indicator_groups.id
                         		WHERE results.survey_id = :surveyId1
                                GROUP BY results.survey_id, indicators.group_id) AS d
						JOIN (SELECT Max_Company_Indicator_Group_Average.Survey_ID as Surveys_ID,
								MAX(Max_Company_Indicator_Group_Average.Indicator_Group_Average) as Maximum_Company_Indicator_Group_Average
                                FROM(SELECT results.survey_id as Survey_ID,
                                		indicators.group_id as Indicator_Group_ID,
                                		indicator_groups.name as Indicator_Group,
                                		AVG(results.answer) as Indicator_Group_Average
                                		FROM indicators
                                		JOIN results on results.indicator_id = indicators.id
                                		JOIN indicator_groups on indicators.group_id = indicator_groups.id
                                     	WHERE results.survey_id = :surveyId2
                                		GROUP BY results.survey_id, indicators.group_id)as Max_Company_Indicator_Group_Average
                                		GROUP BY Max_Company_Indicator_Group_Average.Survey_ID) AS k
						 on d.Survey_ID = k.Surveys_ID
						 WHERE d.Indicator_Group_Average = k.Maximum_Company_Indicator_Group_Average
						 GROUP BY k.Surveys_ID"),
                                array("surveyId1"=>$id,"surveyId2"=>$id));



				//This returns the average of each user group per indicator group in this survey
              $surveyScoreGroupAvgPerIndicatorGroupMinAndMax = DB::select(DB::raw(
                                "SELECT p.Survey_ID, p.Indicator_Group_ID, p.Indicator_Group,
									MIN(p.Indicator_Group_Average) as Minimum_User_Indicator_Group_Average ,
									MAX(p.Indicator_Group_Average) as Maximum_User_Indicator_Group_Average FROM
										(SELECT results.survey_id as Survey_ID, results.user_id as User_ID, indicators.group_id as Indicator_Group_ID,
											indicator_groups.name as Indicator_Group,
											AVG(results.answer) as Indicator_Group_Average
											FROM indicators
											JOIN results on results.indicator_id = indicators.id
											JOIN indicator_groups on indicators.group_id = indicator_groups.id
											WHERE results.survey_id = :surveyId
											GROUP BY results.survey_id, results.user_id, indicators.group_id)
								AS p GROUP BY p.Indicator_Group_ID"),
                                array("surveyId"=>$id));


				$company=Auth::User()->company()->first();
				$company_profile=$company->profile()->first();
								
				$answers = DB::select(DB::raw(
					"select users.id, users.name, users.email from users where users.id in
						(select participants.user_id from participants where participants.survey_id = :surveyId and participants.completed = 1)"),
							array("surveyId"=>$id));
								

              return view('survey.resultForAdmin')->with('survey',Survey::find($id))
              ->with(['surveyScoreAllUsers' => $surveyScoreAllUsers])
              ->with(['surveyGroupAveragePerIndicatorAllUsers' => $surveyGroupAveragePerIndicatorAllUsers])
              ->with(['surveyScorePerIndicatorGroup' => $surveyScorePerIndicatorGroup])
              ->with(['surveyScoreGroupAvgPerIndicatorGroup' => $surveyScoreGroupAvgPerIndicatorGroup])

			  ->with(['surveyScoreGroupAvgPerIndicatorGroupMinAndMax' => $surveyScoreGroupAvgPerIndicatorGroupMinAndMax])

			  ->with(['surveyScoreAllUsersMinimum' => $surveyScoreAllUsersMinimum])
              ->with(['surveyGroupAveragePerIndicatorAllUsersMinimum' => $surveyGroupAveragePerIndicatorAllUsersMinimum])
              ->with(['surveyScorePerIndicatorGroupMinimum' => $surveyScorePerIndicatorGroupMinimum])
              ->with(['surveyScoreGroupAvgPerIndicatorGroupMinimum' => $surveyScoreGroupAvgPerIndicatorGroupMinimum])

			  ->with(['surveyScoreAllUsersMaximum' => $surveyScoreAllUsersMaximum])
              ->with(['surveyGroupAveragePerIndicatorAllUsersMaximum' => $surveyGroupAveragePerIndicatorAllUsersMaximum])
              ->with(['surveyScorePerIndicatorGroupMaximum' => $surveyScorePerIndicatorGroupMaximum])
              ->with(['surveyScoreGroupAvgPerIndicatorGroupMaximum' => $surveyScoreGroupAvgPerIndicatorGroupMaximum])

			  ->with('participants',Survey::find($id)->participants)
              ->with('company',$company)
              ->with('company_profile',$company->profile()->first())
              ->with('answers',$answers);
          }else{
			  //This is peer
			  $surveyScoreAllUsersCheckThreeParticipants = DB::select(DB::raw(
												"select p.user_id from (select peer_results.id, peer_results.peer_survey_id, 
												peer_results.user_id, peer_results.indicator_id, count(peer_results.peer_id) 
												from `peer_results` where peer_results.peer_survey_id = :surveyId group by 
												peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id 
												having count(peer_results.peer_id)>1) as p group by p.user_id"),
                                              array("surveyId"=>$id));
							
                            $surveyScoreAllUsers = DB::select(DB::raw(
												"select peer_results.id, peer_results.peer_survey_id as Survey_ID, peer_results.user_id as User_ID, 
												 peer_results.indicator_id as Indicator_ID, indicators.indicator as Indicator, indicators.group_id as Indicator_Group_ID, 
												 indicator_groups.name as Indicator_Group, avg(peer_results.answer) as Answer from `peer_results`
												 join indicators on indicators.id = peer_results.indicator_id
												 join indicator_groups on indicator_groups.id = indicators.group_id
												 where peer_results.peer_survey_id = :surveyId group by 
												 peer_results.peer_survey_id, peer_results.user_id, 
												 peer_results.indicator_id having count(peer_results.peer_id)>1"),
												array("surveyId"=>$id));


                            //This returns the average of the user group per indicator in this survey
                            $surveyGroupAveragePerIndicatorAllUsers = DB::select(DB::raw(
                                              "select p.id, p.peer_survey_id as Survey_ID, p.indicator_id as Indicator_ID, p.indicator as Indicator, avg(p.Group_Average) as Group_Average from 
											  (select peer_results.id, peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id, 
											  indicators.indicator, indicators.group_id, indicator_groups.name, avg(peer_results.answer) as Group_Average 
											  from `peer_results`
											  join indicators on indicators.id = peer_results.indicator_id
											  join indicator_groups on indicator_groups.id = indicators.group_id
											  where peer_results.peer_survey_id = :surveyId group by 
											  peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id 
											  having count(peer_results.peer_id)>1) as p group by p.peer_survey_id, p.indicator_id"),
                                              array("surveyId"=>$id));

                            //This returns the average of each user per indicator group for this survey
                            $surveyScoreGroupAvgPerIndicatorGroup = DB::select(DB::raw(
                                              "select p.id, p.peer_survey_id as Survey_ID, p.user_id as User_ID, p.group_id as Indicator_Group_ID, p.name as Indicator_Group, avg(p.Indicator_Group_Average) as Indicator_Group_Average from 
											  (select peer_results.id, peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id, 
											  indicators.indicator, indicators.group_id, indicator_groups.name, avg(peer_results.answer) as Indicator_Group_Average 
											  from `peer_results`
											  join indicators on indicators.id = peer_results.indicator_id
											  join indicator_groups on indicator_groups.id = indicators.group_id
											  where peer_results.peer_survey_id = :surveyId group by 
											  peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id 
											  having count(peer_results.peer_id)>1) as p group by p.peer_survey_id, p.user_id, p.group_id"),
                                              array("surveyId"=>$id));

                            //This returns the average of each user group per indicator group in this survey
                            $surveyScorePerIndicatorGroup = DB::select(DB::raw(
                                              "select p.id, p.peer_survey_id as Survey_ID, p.group_id as Indicator_Group_ID, p.name as Indicator_Group, avg(p.Indicator_Group_Average) as Indicator_Group_Average from 
											  (select peer_results.id, peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id, 
											  indicators.indicator, indicators.group_id, indicator_groups.name, avg(peer_results.answer) as Indicator_Group_Average 
											  from `peer_results`
											  join indicators on indicators.id = peer_results.indicator_id
											  join indicator_groups on indicator_groups.id = indicators.group_id
											  where peer_results.peer_survey_id = :surveyId group by 
											  peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id 
											  having count(peer_results.peer_id)>1) as p group by p.peer_survey_id, p.group_id"),
                                              array("surveyId"=>$id));
							
							$company=Auth::User()->company()->first();
							$company_profile=$company->profile()->first();
							
							
							//This returns the minimum and maximum average per indicator group in this survey
							$surveyScoreGroupAvgPerIndicatorGroupMinAndMax = DB::select(DB::raw(
                                "SELECT d.Survey_ID, d.Indicator_Group_ID, d.Indicator_Group,
									MIN(d.Indicator_Group_Average) as Minimum_User_Indicator_Group_Average ,
									MAX(d.Indicator_Group_Average) as Maximum_User_Indicator_Group_Average FROM
										(select p.id, p.peer_survey_id as Survey_ID, p.user_id as User_ID, p.group_id as Indicator_Group_ID, p.name as Indicator_Group, avg(p.Indicator_Group_Average) as Indicator_Group_Average from 
											  (select peer_results.id, peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id, 
											  indicators.indicator, indicators.group_id, indicator_groups.name, avg(peer_results.answer) as Indicator_Group_Average 
											  from `peer_results`
											  join indicators on indicators.id = peer_results.indicator_id
											  join indicator_groups on indicator_groups.id = indicators.group_id
											  where peer_results.peer_survey_id = :surveyId group by 
											  peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id 
											  having count(peer_results.peer_id)>1) as p group by p.peer_survey_id, p.user_id, p.group_id)
								AS d GROUP BY d.Indicator_Group_ID"),
                                array("surveyId"=>$id));
							
							
							$answers = DB::select(DB::raw(
									"select users.id, users.name, users.email from users where users.id in
										(select p.user_id from (select peer_results.id, peer_results.peer_survey_id, 
												peer_results.user_id, peer_results.indicator_id, count(peer_results.peer_id) 
												from `peer_results` where peer_results.peer_survey_id = :surveyId group by 
												peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id 
												having count(peer_results.peer_id)>1) as p group by p.user_id)"),
											array("surveyId"=>$id));
					
						  

                            return view('survey.resultForAdmin')->with('survey',Survey::find($id))
                            ->with(['surveyScoreAllUsers' => $surveyScoreAllUsers])
                            ->with(['surveyScoreAllUsersCheckThreeParticipants' => $surveyScoreAllUsersCheckThreeParticipants])
							->with(['surveyGroupAveragePerIndicatorAllUsers' => $surveyGroupAveragePerIndicatorAllUsers])
                            ->with(['surveyScorePerIndicatorGroup' => $surveyScorePerIndicatorGroup])
                            ->with(['surveyScoreGroupAvgPerIndicatorGroup' => $surveyScoreGroupAvgPerIndicatorGroup])
                            ->with('participants',Survey::find($id)->participants)
                            ->with('company',$company)
						    ->with('company_profile',$company->profile()->first())
						    ->with(['surveyScoreGroupAvgPerIndicatorGroupMinAndMax' => $surveyScoreGroupAvgPerIndicatorGroupMinAndMax])
							->with('answers',$answers);
		  }
		  }

      }else{
          return view('errors.404')->with('title',' Survey Not found')
              ->with('message','The survey you requested doe not belong to your company or does not exists in the Fincoda Survey System.');
      }
    }

public function getParticipantDetails($surveyId, $participantId){
	  $id = $surveyId;
      $userId = $participantId;
	  if($this->ValidateSurvey($id)=='true'){
          if($this->SurveyStatus($id)=='pending'){
              $this->editSurvey($id);
          }else{
			  if ($this->SurveyType($id) == 'self') {
              //This returns the indicator scores for each user that took part in the survey
              //Used native or raw queries because laravel has no support for listed grouping on aggregate functions
              //In other words it will always return a single result
              $surveyScoreAllUsers = DB::table('indicators')
                                ->join('results','results.indicator_id','=','indicators.id')
                                ->join('indicator_groups','indicators.group_id','=','indicator_groups.id')
                                ->join('users','users.id','=','results.user_id')
                                ->select('results.survey_id as Survey_ID', 'users.email as Email', 'users.name as Name',
                                         'results.user_id as User_ID','indicators.id as Indicator_ID',
                                         'indicators.indicator as Indicator', 'results.answer as Answer',
                                         'indicators.group_id as Indicator_Group_ID','indicator_groups.name as Indicator_Group')
                                ->where('results.survey_id',$id)
                                ->where('results.user_id',$userId)
                                ->groupBy('results.user_id', 'results.survey_id', 'indicators.id')
                                ->get();


              //This returns the average of the user group per indicator in this survey
              $surveyGroupAveragePerIndicatorAllUsers = DB::select(DB::raw(
                                "SELECT results.survey_id as Survey_ID,
                                indicators.id as Indicator_ID, indicators.indicator as Indicator,
                                AVG(results.answer) as Group_Average
                                FROM indicators
                                join results on results.indicator_id = indicators.id
                                WHERE results.survey_id = :surveyId
								                GROUP BY results.survey_id, indicators.id"),
                                array("surveyId"=>$id));

              //This returns the average of each user per indicator group for this survey
              $surveyScoreGroupAvgPerIndicatorGroup = DB::select(DB::raw(
                                "SELECT results.survey_id as Survey_ID,
                                results.user_id as User_ID, indicators.group_id as Indicator_Group_ID,
                                indicator_groups.name as Indicator_Group,
                                AVG(results.answer) as Indicator_Group_Average
                                FROM indicators
                                JOIN results on results.indicator_id = indicators.id
                                JOIN indicator_groups on indicators.group_id = indicator_groups.id
                                WHERE results.survey_id = :surveyId
								                GROUP BY results.survey_id, results.user_id, indicators.group_id"),
                                array("surveyId"=>$id));

              //This returns the average of each user group per indicator group in this survey
              $surveyScorePerIndicatorGroup = DB::select(DB::raw(
                                "SELECT results.survey_id as Survey_ID,
                                indicators.group_id as Indicator_Group_ID,
                                indicator_groups.name as Indicator_Group,
                                AVG(results.answer) as Indicator_Group_Average
                                FROM indicators
                                JOIN results on results.indicator_id = indicators.id
                                JOIN indicator_groups on indicators.group_id = indicator_groups.id
                                WHERE results.survey_id = :surveyId
                                GROUP BY results.survey_id, indicators.group_id"),
                                array("surveyId"=>$id));

                                $company=Auth::User()->company()->first();
                                $company_profile=$company->profile()->first();

				//This selects the indicators on which the participant scored minimum values: the query becomes complex because of the possibility of
				//different indicators having the same minimum value
			  $surveyScoreAllUsersMinimum = DB::select(DB::raw("SELECT k.Surveys_ID, k.Users_ID, d.Indicator_ID, d.Indicator, k.Minimum_Answer
								FROM (select results.survey_id as Survey_ID, results.user_id as User_ID, indicators.id as Indicator_ID,
										indicators.indicator as Indicator, results.answer as Answer, indicators.group_id as Indicator_Group_ID,
										indicator_groups.name as Indicator_Group FROM indicators
										JOIN results on results.indicator_id = indicators.id
										JOIN indicator_groups on indicators.group_id = indicator_groups.id
										WHERE results.survey_id = :surveyId1
										GROUP BY results.survey_id, results.user_id, indicators.id)
								as d
								JOIN (SELECT Min_Answer.Survey_ID as Surveys_ID, Min_Answer.User_ID as Users_ID, MIN(Min_Answer.Answer) as Minimum_Answer
										FROM (select results.survey_id as Survey_ID, results.user_id as User_ID,
											  indicators.id as Indicator_ID, indicators.indicator as Indicator,
											  results.answer as Answer, indicators.group_id as Indicator_Group_ID,
											  indicator_groups.name as Indicator_Group FROM indicators
											  JOIN results on results.indicator_id = indicators.id
											  JOIN indicator_groups on indicators.group_id = indicator_groups.id
											  WHERE results.survey_id = :surveyId2
											  GROUP BY results.survey_id, results.user_id, indicators.id)
										as Min_Answer
										GROUP by Min_Answer.Survey_ID, Min_Answer.User_ID)
								as k on d.Survey_ID = k.Surveys_ID
								WHERE d.Answer = k.Minimum_Answer
								GROUP BY k.Surveys_ID, k.Users_ID, d.Indicator_ID"),
                                array("surveyId1"=>$id,"surveyId2"=>$id));

				//This selects the indicators on which the participant scored maximum values: the query becomes complex because of the possibility of
				//different indicators having the same maximum value
			  $surveyScoreAllUsersMaximum = DB::select(DB::raw("SELECT k.Surveys_ID, k.Users_ID, d.Indicator_ID, d.Indicator, k.Maximum_Answer
								FROM (select results.survey_id as Survey_ID, results.user_id as User_ID, indicators.id as Indicator_ID,
										indicators.indicator as Indicator, results.answer as Answer, indicators.group_id as Indicator_Group_ID,
										indicator_groups.name as Indicator_Group FROM indicators JOIN results on results.indicator_id = indicators.id
										JOIN indicator_groups on indicators.group_id = indicator_groups.id WHERE results.survey_id = :surveyId1
										GROUP BY results.survey_id, results.user_id, indicators.id) as d
								JOIN (SELECT Max_Answer.Survey_ID as Surveys_ID, Max_Answer.User_ID as Users_ID, MAX(Max_Answer.Answer) as Maximum_Answer
											FROM (select results.survey_id as Survey_ID, results.user_id as User_ID, indicators.id as Indicator_ID,
													indicators.indicator as Indicator, results.answer as Answer, indicators.group_id as Indicator_Group_ID,
													indicator_groups.name as Indicator_Group FROM indicators
													JOIN results on results.indicator_id = indicators.id
													JOIN indicator_groups on indicators.group_id = indicator_groups.id
													WHERE results.survey_id = :surveyId2
													GROUP BY results.survey_id, results.user_id, indicators.id) as Max_Answer
											GROUP by Max_Answer.Survey_ID, Max_Answer.User_ID)
								as k on d.Survey_ID = k.Surveys_ID
								WHERE d.Answer = k.Maximum_Answer
								GROUP BY k.Surveys_ID, k.Users_ID, d.Indicator_ID"),
                                array("surveyId1"=>$id,"surveyId2"=>$id));


			  //This selects the indicators on which the participant scored minimum averages: the query becomes complex because of the possibility of
				//different indicators having the same minimum value
			  $surveyGroupAveragePerIndicatorAllUsersMinimum = DB::select(DB::raw("SELECT k.Surveys_ID, d.Indicator_ID, d.Indicator, k.Minimum_Average FROM
										(SELECT results.survey_id as Survey_ID,
                                              indicators.id as Indicator_ID, indicators.indicator as Indicator,
                                              ROUND (AVG(results.answer), 2) as Group_Average
                                              FROM indicators
                                              JOIN results on results.indicator_id = indicators.id
                                              WHERE results.survey_id = :surveyId1
                                              GROUP BY results.survey_id, indicators.id)
										as d
                                        JOIN (SELECT Min_Average.Survey_ID as Surveys_ID, MIN(Min_Average.Group_Average) as Minimum_Average
												FROM (SELECT results.survey_id as Survey_ID,
													indicators.id as Indicator_ID, indicators.indicator as Indicator,
													ROUND (AVG(results.answer),2) AS Group_Average
													FROM indicators
													JOIN results on results.indicator_id = indicators.id
													WHERE results.survey_id = :surveyId2
													GROUP BY results.survey_id, indicators.id)
												AS Min_Average GROUP by Min_Average.Survey_ID)
										AS k on d.Survey_ID = k.Surveys_ID
                                        WHERE d.Group_Average = k.Minimum_Average
                                        GROUP BY k.Surveys_ID, d.Indicator_ID"),
                                array("surveyId1"=>$id,"surveyId2"=>$id));


				//This selects the indicators on which the participant scored maximum averages: the query becomes complex because of the possibility of
				//different indicators having the same maximum value
			  $surveyGroupAveragePerIndicatorAllUsersMaximum = DB::select(DB::raw("SELECT k.Surveys_ID, d.Indicator_ID, d.Indicator, k.Maximum_Average
										FROM (SELECT results.survey_id as Survey_ID, indicators.id as Indicator_ID, indicators.indicator as Indicator,
                                              ROUND (AVG(results.answer), 2) as Group_Average
                                              FROM indicators
                                              JOIN results on results.indicator_id = indicators.id
                                              WHERE results.survey_id = :surveyId1
                                              GROUP BY results.survey_id, indicators.id) as d
                                        JOIN (SELECT Max_Average.Survey_ID as Surveys_ID, MAX(Max_Average.Group_Average) as Maximum_Average
												FROM (SELECT results.survey_id as Survey_ID,
														indicators.id as Indicator_ID, indicators.indicator as Indicator,
														ROUND (AVG(results.answer),2) AS Group_Average
														FROM indicators
														JOIN results on results.indicator_id = indicators.id
														WHERE results.survey_id = :surveyId2
														GROUP BY results.survey_id, indicators.id) AS Max_Average
												GROUP by Max_Average.Survey_ID)
											  AS k on d.Survey_ID = k.Surveys_ID
                                        WHERE d.Group_Average = k.Maximum_Average
                                        GROUP BY k.Surveys_ID, d.Indicator"),
                                array("surveyId1"=>$id,"surveyId2"=>$id));


					//This selects the indicator groups on which the participant scored minimum averages: the query becomes complex because of the possibility of
				//different indicator groups having the same value
			  $surveyScoreGroupAvgPerIndicatorGroupMinimum = DB::select(DB::raw("SELECT k.Surveys_ID, k.Users_ID, d.Indicator_Group_ID, d.Indicator_Group, k.Minimum_Indicator_Group_Average
												FROM (SELECT results.survey_id as Survey_ID, results.user_id as User_ID, indicators.group_id as Indicator_Group_ID,
															indicator_groups.name as Indicator_Group, ROUND(AVG(results.answer), 2) as Indicator_Group_Average FROM indicators
															JOIN results on results.indicator_id = indicators.id
															JOIN indicator_groups on indicators.group_id = indicator_groups.id
															WHERE results.survey_id = :surveyId1
															GROUP BY results.survey_id, results.user_id, indicators.group_id)
												AS d
                                                JOIN (SELECT Min_Indicator_Group_Average.Survey_ID as Surveys_ID,
															Min_Indicator_Group_Average.User_ID as Users_ID,
															MIN(Min_Indicator_Group_Average.Indicator_Group_Average) as Minimum_Indicator_Group_Average
															FROM (SELECT results.survey_id as Survey_ID, results.user_id as User_ID, indicators.group_id as Indicator_Group_ID,
																	indicator_groups.name as Indicator_Group, ROUND(AVG(results.answer), 2) as Indicator_Group_Average
																	FROM indicators
																	JOIN results on results.indicator_id = indicators.id
																	JOIN indicator_groups on indicators.group_id = indicator_groups.id
																	WHERE results.survey_id = :surveyId2
																	GROUP BY results.survey_id, results.user_id, indicators.group_id)
																  AS Min_Indicator_Group_Average
															GROUP BY Min_Indicator_Group_Average.Survey_ID, Min_Indicator_Group_Average.User_ID)
												AS k
                                                ON d.Survey_ID = k.Surveys_ID
                                                WHERE d.Indicator_Group_Average = k.Minimum_Indicator_Group_Average
                                                GROUP BY k.Surveys_ID, k.Users_ID"),
                                array("surveyId1"=>$id,"surveyId2"=>$id));


				//This selects the indicator groups on which the participant scored maximum averages: the query becomes complex because of the possibility of
				//different indicator groups having the same value
			  $surveyScoreGroupAvgPerIndicatorGroupMaximum = DB::select(DB::raw("SELECT k.Surveys_ID, k.Users_ID, d.Indicator_Group_ID, d.Indicator_Group, k.Maximum_Indicator_Group_Average
                            	FROM (SELECT results.survey_id as Survey_ID, results.user_id as User_ID, indicators.group_id as Indicator_Group_ID, indicator_groups.name as Indicator_Group, 																ROUND(AVG(results.answer), 2) as Indicator_Group_Average FROM indicators
                                      	JOIN results on results.indicator_id = indicators.id
                                      	JOIN indicator_groups on indicators.group_id = indicator_groups.id
                                      	WHERE results.survey_id = :surveyId1
                                      	GROUP BY results.survey_id, results.user_id, indicators.group_id)
                                      AS d
                                 JOIN (SELECT Max_Indicator_Group_Average.Survey_ID as Surveys_ID, Max_Indicator_Group_Average.User_ID as Users_ID,
                                       MAX(Max_Indicator_Group_Average.Indicator_Group_Average) as Maximum_Indicator_Group_Average
                                            		FROM (SELECT results.survey_id as Survey_ID, results.user_id as User_ID, indicators.group_id as Indicator_Group_ID,
                                              					indicator_groups.name as Indicator_Group, ROUND(AVG(results.answer), 2) as Indicator_Group_Average
                                              					FROM indicators
                                              					JOIN results on results.indicator_id = indicators.id
                                              					JOIN indicator_groups on indicators.group_id = indicator_groups.id
                                                    			WHERE results.survey_id = :surveyId2
                                              					GROUP BY results.survey_id, results.user_id, indicators.group_id)
                                       AS Max_Indicator_Group_Average
                                       GROUP BY Max_Indicator_Group_Average.Survey_ID, Max_Indicator_Group_Average.User_ID)
                                  AS k on d.Survey_ID = k.Surveys_ID
                                  WHERE d.Indicator_Group_Average = k.Maximum_Indicator_Group_Average
                                  GROUP BY k.Surveys_ID, k.Users_ID"),
                                array("surveyId1"=>$id,"surveyId2"=>$id));


				//This selects the indicator groups on which all the participants scored minimum averages: the query becomes complex because of the possibility of
				//different indicator groups having the same value
			  $surveyScorePerIndicatorGroupMinimum = DB::select(DB::raw("SELECT k.Surveys_ID, d.Indicator_Group_ID, d.Indicator_Group, k.Minimum_Company_Indicator_Group_Average
						FROM (SELECT results.survey_id as Survey_ID,
                                indicators.group_id as Indicator_Group_ID,
                                indicator_groups.name as Indicator_Group,
                                AVG(results.answer) as Indicator_Group_Average
                                FROM indicators
                                JOIN results on results.indicator_id = indicators.id
                                JOIN indicator_groups on indicators.group_id = indicator_groups.id
								WHERE results.survey_id = :surveyId1
                                GROUP BY results.survey_id, indicators.group_id)
                              AS d
						JOIN (SELECT Min_Company_Indicator_Group_Average.Survey_ID as Surveys_ID,
								MIN(Min_Company_Indicator_Group_Average.Indicator_Group_Average) as Minimum_Company_Indicator_Group_Average
                                	FROM(SELECT results.survey_id as Survey_ID,
                                		indicators.group_id as Indicator_Group_ID,
                                		indicator_groups.name as Indicator_Group,
                                		AVG(results.answer) as Indicator_Group_Average
                                		FROM indicators
                                		JOIN results on results.indicator_id = indicators.id
                                		JOIN indicator_groups on indicators.group_id = indicator_groups.id
                                		WHERE results.survey_id = :surveyId2
                                      	GROUP BY results.survey_id, indicators.group_id) AS Min_Company_Indicator_Group_Average
                                		GROUP BY Min_Company_Indicator_Group_Average.Survey_ID)
                          AS k ON d.Survey_ID = k.Surveys_ID
                          WHERE d.Indicator_Group_Average = k.Minimum_Company_Indicator_Group_Average
                          GROUP BY k.Surveys_ID"),
                                array("surveyId1"=>$id,"surveyId2"=>$id));


				//This selects the indicator groups on which all the participants scored maximum averages: the query becomes complex because of the possibility of
				//different indicator groups having the same value
			  $surveyScorePerIndicatorGroupMaximum = DB::select(DB::raw("SELECT k.Surveys_ID, d.Indicator_Group_ID, d.Indicator_Group, k.Maximum_Company_Indicator_Group_Average FROM
						(SELECT results.survey_id as Survey_ID,
                                indicators.group_id as Indicator_Group_ID,
                                indicator_groups.name as Indicator_Group,
                                AVG(results.answer) as Indicator_Group_Average
                                FROM indicators
                                JOIN results on results.indicator_id = indicators.id
                                JOIN indicator_groups on indicators.group_id = indicator_groups.id
                         		WHERE results.survey_id = :surveyId1
                                GROUP BY results.survey_id, indicators.group_id) AS d
						JOIN (SELECT Max_Company_Indicator_Group_Average.Survey_ID as Surveys_ID,
								MAX(Max_Company_Indicator_Group_Average.Indicator_Group_Average) as Maximum_Company_Indicator_Group_Average
                                FROM(SELECT results.survey_id as Survey_ID,
                                		indicators.group_id as Indicator_Group_ID,
                                		indicator_groups.name as Indicator_Group,
                                		AVG(results.answer) as Indicator_Group_Average
                                		FROM indicators
                                		JOIN results on results.indicator_id = indicators.id
                                		JOIN indicator_groups on indicators.group_id = indicator_groups.id
                                     	WHERE results.survey_id = :surveyId2
                                		GROUP BY results.survey_id, indicators.group_id)as Max_Company_Indicator_Group_Average
                                		GROUP BY Max_Company_Indicator_Group_Average.Survey_ID) AS k
						 on d.Survey_ID = k.Surveys_ID
						 WHERE d.Indicator_Group_Average = k.Maximum_Company_Indicator_Group_Average
						 GROUP BY k.Surveys_ID"),
                                array("surveyId1"=>$id,"surveyId2"=>$id));



				//This returns the minimum and maximum average per indicator group in this survey
              $surveyScoreGroupAvgPerIndicatorGroupMinAndMax = DB::select(DB::raw(
                                "SELECT p.Survey_ID, p.Indicator_Group_ID, p.Indicator_Group,
									MIN(p.Indicator_Group_Average) as Minimum_User_Indicator_Group_Average ,
									MAX(p.Indicator_Group_Average) as Maximum_User_Indicator_Group_Average FROM
										(SELECT results.survey_id as Survey_ID, results.user_id as User_ID, indicators.group_id as Indicator_Group_ID,
											indicator_groups.name as Indicator_Group,
											AVG(results.answer) as Indicator_Group_Average
											FROM indicators
											JOIN results on results.indicator_id = indicators.id
											JOIN indicator_groups on indicators.group_id = indicator_groups.id
											WHERE results.survey_id = :surveyId
											GROUP BY results.survey_id, results.user_id, indicators.group_id)
								AS p GROUP BY p.Indicator_Group_ID"),
                                array("surveyId"=>$id));


				$company=Auth::User()->company()->first();
				$company_profile=$company->profile()->first();
				
				$answers = DB::select(DB::raw(
					"select users.id, users.name, users.email from users where users.id in
						(select participants.user_id from participants where participants.survey_id = :surveyId and participants.completed = 1)"),
							array("surveyId"=>$id));
							

              return view('survey.resultForIndividualInAdmin')->with('survey',Survey::find($id))
              ->with(['surveyScoreAllUsers' => $surveyScoreAllUsers])
              ->with(['surveyGroupAveragePerIndicatorAllUsers' => $surveyGroupAveragePerIndicatorAllUsers])
              ->with(['surveyScorePerIndicatorGroup' => $surveyScorePerIndicatorGroup])
              ->with(['surveyScoreGroupAvgPerIndicatorGroup' => $surveyScoreGroupAvgPerIndicatorGroup])

			  ->with(['surveyScoreGroupAvgPerIndicatorGroupMinAndMax' => $surveyScoreGroupAvgPerIndicatorGroupMinAndMax])

			  ->with(['surveyScoreAllUsersMinimum' => $surveyScoreAllUsersMinimum])
              ->with(['surveyGroupAveragePerIndicatorAllUsersMinimum' => $surveyGroupAveragePerIndicatorAllUsersMinimum])
              ->with(['surveyScorePerIndicatorGroupMinimum' => $surveyScorePerIndicatorGroupMinimum])
              ->with(['surveyScoreGroupAvgPerIndicatorGroupMinimum' => $surveyScoreGroupAvgPerIndicatorGroupMinimum])

			  ->with(['surveyScoreAllUsersMaximum' => $surveyScoreAllUsersMaximum])
              ->with(['surveyGroupAveragePerIndicatorAllUsersMaximum' => $surveyGroupAveragePerIndicatorAllUsersMaximum])
              ->with(['surveyScorePerIndicatorGroupMaximum' => $surveyScorePerIndicatorGroupMaximum])
              ->with(['surveyScoreGroupAvgPerIndicatorGroupMaximum' => $surveyScoreGroupAvgPerIndicatorGroupMaximum])

			  ->with('participants',Survey::find($id)->participants)
              ->with('company',$company)
              ->with('user',$userId)
              ->with('company_profile',$company->profile()->first())
              ->with('answers',$answers);
          }else{
			  //This is peer
			  //In the peer survey results check if more than one peer have evaluated this user_id (also did this at the model level)
				$evaluatorsCompleted = DB::select(DB::raw(
									"select users.id, users.name, users.email from users where users.id in
										(select peer_results.peer_id from peer_results where peer_results.peer_survey_id = :surveyId 
											and peer_results.user_id = :currentUser)"),
											array("surveyId"=>$id,"currentUser"=>$userId));
											
					$surveyScoreAllUsersCheckThreeParticipants = DB::select(DB::raw(
												"select p.user_id from (select peer_results.id, peer_results.peer_survey_id, 
												peer_results.user_id, peer_results.indicator_id, count(peer_results.peer_id) 
												from `peer_results` where peer_results.peer_survey_id = :surveyId group by 
												peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id 
												having count(peer_results.peer_id)>1) as p group by p.user_id"),
                                              array("surveyId"=>$id));
							
                            $surveyScoreAllUsers = DB::select(DB::raw(
												"select peer_results.id, peer_results.peer_survey_id as Survey_ID, peer_results.user_id as User_ID, 
												 peer_results.indicator_id as Indicator_ID, indicators.indicator as Indicator, indicators.group_id as Indicator_Group_ID, 
												 indicator_groups.name as Indicator_Group, avg(peer_results.answer) as Answer from `peer_results`
												 join indicators on indicators.id = peer_results.indicator_id
												 join indicator_groups on indicator_groups.id = indicators.group_id
												 where peer_results.peer_survey_id = :surveyId and peer_results.user_id = :userId group by 
												 peer_results.peer_survey_id, peer_results.user_id, 
												 peer_results.indicator_id having count(peer_results.peer_id)>1"),
												array("surveyId"=>$id,"userId"=>$participantId));


                            //This returns the average of the user group per indicator in this survey
                            $surveyGroupAveragePerIndicatorAllUsers = DB::select(DB::raw(
                                              "select p.id, p.peer_survey_id as Survey_ID, p.indicator_id as Indicator_ID, p.indicator as Indicator, avg(p.Group_Average) as Group_Average from 
											  (select peer_results.id, peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id, 
											  indicators.indicator, indicators.group_id, indicator_groups.name, avg(peer_results.answer) as Group_Average 
											  from `peer_results`
											  join indicators on indicators.id = peer_results.indicator_id
											  join indicator_groups on indicator_groups.id = indicators.group_id
											  where peer_results.peer_survey_id = :surveyId group by 
											  peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id 
											  having count(peer_results.peer_id)>1) as p group by p.peer_survey_id, p.indicator_id"),
                                              array("surveyId"=>$id));

                            //This returns the average of each user per indicator group for this survey
                            $surveyScoreGroupAvgPerIndicatorGroup = DB::select(DB::raw(
                                              "select p.id, p.peer_survey_id as Survey_ID, p.user_id as User_ID, p.group_id as Indicator_Group_ID, p.name as Indicator_Group, avg(p.Indicator_Group_Average) as Indicator_Group_Average from 
											  (select peer_results.id, peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id, 
											  indicators.indicator, indicators.group_id, indicator_groups.name, avg(peer_results.answer) as Indicator_Group_Average 
											  from `peer_results`
											  join indicators on indicators.id = peer_results.indicator_id
											  join indicator_groups on indicator_groups.id = indicators.group_id
											  where peer_results.peer_survey_id = :surveyId group by 
											  peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id 
											  having count(peer_results.peer_id)>1) as p group by p.peer_survey_id, p.user_id, p.group_id"),
                                              array("surveyId"=>$id));

                            //This returns the average of each user group per indicator group in this survey
                            $surveyScorePerIndicatorGroup = DB::select(DB::raw(
                                              "select p.id, p.peer_survey_id as Survey_ID, p.group_id as Indicator_Group_ID, p.name as Indicator_Group, avg(p.Indicator_Group_Average) as Indicator_Group_Average from 
											  (select peer_results.id, peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id, 
											  indicators.indicator, indicators.group_id, indicator_groups.name, avg(peer_results.answer) as Indicator_Group_Average 
											  from `peer_results`
											  join indicators on indicators.id = peer_results.indicator_id
											  join indicator_groups on indicator_groups.id = indicators.group_id
											  where peer_results.peer_survey_id = :surveyId group by 
											  peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id 
											  having count(peer_results.peer_id)>1) as p group by p.peer_survey_id, p.group_id"),
                                              array("surveyId"=>$id));
							
							$company=Auth::User()->company()->first();
							$company_profile=$company->profile()->first();
							
							
							//This returns the minimum and maximum average per indicator group in this survey
							$surveyScoreGroupAvgPerIndicatorGroupMinAndMax = DB::select(DB::raw(
                                "SELECT d.Survey_ID, d.Indicator_Group_ID, d.Indicator_Group,
									MIN(d.Indicator_Group_Average) as Minimum_User_Indicator_Group_Average ,
									MAX(d.Indicator_Group_Average) as Maximum_User_Indicator_Group_Average FROM
										(select p.id, p.peer_survey_id as Survey_ID, p.user_id as User_ID, p.group_id as Indicator_Group_ID, p.name as Indicator_Group, avg(p.Indicator_Group_Average) as Indicator_Group_Average from 
											  (select peer_results.id, peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id, 
											  indicators.indicator, indicators.group_id, indicator_groups.name, avg(peer_results.answer) as Indicator_Group_Average 
											  from `peer_results`
											  join indicators on indicators.id = peer_results.indicator_id
											  join indicator_groups on indicator_groups.id = indicators.group_id
											  where peer_results.peer_survey_id = :surveyId group by 
											  peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id 
											  having count(peer_results.peer_id)>1) as p group by p.peer_survey_id, p.user_id, p.group_id)
								AS d GROUP BY d.Indicator_Group_ID"),
                                array("surveyId"=>$id));
							
							
							$answers = DB::select(DB::raw(
									"select users.id, users.name, users.email from users where users.id in
										(select p.user_id from (select peer_results.id, peer_results.peer_survey_id, 
												peer_results.user_id, peer_results.indicator_id, count(peer_results.peer_id) 
												from `peer_results` where peer_results.peer_survey_id = :surveyId group by 
												peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id 
												having count(peer_results.peer_id)>1) as p group by p.user_id)"),
											array("surveyId"=>$id));
					
						  

                            return view('survey.resultForIndividualInAdmin')->with('survey',Survey::find($surveyId))
                            ->with(['surveyScoreAllUsers' => $surveyScoreAllUsers])
                            ->with(['surveyScoreAllUsersCheckThreeParticipants' => $surveyScoreAllUsersCheckThreeParticipants])
							->with(['surveyGroupAveragePerIndicatorAllUsers' => $surveyGroupAveragePerIndicatorAllUsers])
                            ->with(['surveyScorePerIndicatorGroup' => $surveyScorePerIndicatorGroup])
                            ->with(['surveyScoreGroupAvgPerIndicatorGroup' => $surveyScoreGroupAvgPerIndicatorGroup])
                            ->with('participants',Survey::find($surveyId)->participants)
                            ->with('user',$userId)
							->with('company',$company)
						    ->with('company_profile',$company->profile()->first())
						    ->with(['surveyScoreGroupAvgPerIndicatorGroupMinAndMax' => $surveyScoreGroupAvgPerIndicatorGroupMinAndMax])
							->with('answers',$answers);
				
		  }
		  }

      }else{
          return view('errors.404')->with('title',' Survey Not found')
              ->with('message','The survey you requested doe not belong to your company or does not exists in the Fincoda Survey System.');
      }

    }
	

	public function viewPeerResultsParticipant($surveyId, $userId){
				//In the peer survey results check if more than one peer have evaluated this user_id
				$evaluatorsCompleted = DB::select(DB::raw(
									"select users.id, users.name, users.email from users where users.id in
										(select peer_results.peer_id from peer_results where peer_results.peer_survey_id = :surveyId 
											and peer_results.user_id = :currentUser)"),
											array("surveyId"=>$surveyId,"currentUser"=>$userId));
											
				//if(count($evaluatorsCompleted)>1){
					$surveyScoreAllUsersCheckThreeParticipants = DB::select(DB::raw(
												"select p.user_id from (select peer_results.id, peer_results.peer_survey_id, 
												peer_results.user_id, peer_results.indicator_id, count(peer_results.peer_id) 
												from `peer_results` where peer_results.peer_survey_id = :surveyId group by 
												peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id 
												having count(peer_results.peer_id)>1) as p group by p.user_id"),
                                              array("surveyId"=>$surveyId));
							
                            $surveyScoreAllUsers = DB::select(DB::raw(
												"select peer_results.id, peer_results.peer_survey_id as Survey_ID, peer_results.user_id as User_ID, 
												 peer_results.indicator_id as Indicator_ID, indicators.indicator as Indicator, indicators.group_id as Indicator_Group_ID, 
												 indicator_groups.name as Indicator_Group, avg(peer_results.answer) as Answer from `peer_results`
												 join indicators on indicators.id = peer_results.indicator_id
												 join indicator_groups on indicator_groups.id = indicators.group_id
												 where peer_results.peer_survey_id = :surveyId and peer_results.user_id = :userId group by 
												 peer_results.peer_survey_id, peer_results.user_id, 
												 peer_results.indicator_id having count(peer_results.peer_id)>1"),
												array("surveyId"=>$surveyId,"userId"=>$userId));


                            //This returns the average of the user group per indicator in this survey
                            $surveyGroupAveragePerIndicatorAllUsers = DB::select(DB::raw(
                                              "select p.id, p.peer_survey_id as Survey_ID, p.indicator_id as Indicator_ID, p.indicator as Indicator, avg(p.Group_Average) as Group_Average from 
											  (select peer_results.id, peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id, 
											  indicators.indicator, indicators.group_id, indicator_groups.name, avg(peer_results.answer) as Group_Average 
											  from `peer_results`
											  join indicators on indicators.id = peer_results.indicator_id
											  join indicator_groups on indicator_groups.id = indicators.group_id
											  where peer_results.peer_survey_id = :surveyId group by 
											  peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id 
											  having count(peer_results.peer_id)>1) as p group by p.peer_survey_id, p.indicator_id"),
                                              array("surveyId"=>$surveyId));

                            //This returns the average of each user per indicator group for this survey
                            $surveyScoreGroupAvgPerIndicatorGroup = DB::select(DB::raw(
                                              "select p.id, p.peer_survey_id as Survey_ID, p.user_id as User_ID, p.group_id as Indicator_Group_ID, p.name as Indicator_Group, avg(p.Indicator_Group_Average) as Indicator_Group_Average from 
											  (select peer_results.id, peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id, 
											  indicators.indicator, indicators.group_id, indicator_groups.name, avg(peer_results.answer) as Indicator_Group_Average 
											  from `peer_results`
											  join indicators on indicators.id = peer_results.indicator_id
											  join indicator_groups on indicator_groups.id = indicators.group_id
											  where peer_results.peer_survey_id = :surveyId group by 
											  peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id 
											  having count(peer_results.peer_id)>1) as p group by p.peer_survey_id, p.user_id, p.group_id"),
                                              array("surveyId"=>$surveyId));

                            //This returns the average of each user group per indicator group in this survey
                            $surveyScorePerIndicatorGroup = DB::select(DB::raw(
                                              "select p.id, p.peer_survey_id as Survey_ID, p.group_id as Indicator_Group_ID, p.name as Indicator_Group, avg(p.Indicator_Group_Average) as Indicator_Group_Average from 
											  (select peer_results.id, peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id, 
											  indicators.indicator, indicators.group_id, indicator_groups.name, avg(peer_results.answer) as Indicator_Group_Average 
											  from `peer_results`
											  join indicators on indicators.id = peer_results.indicator_id
											  join indicator_groups on indicator_groups.id = indicators.group_id
											  where peer_results.peer_survey_id = :surveyId group by 
											  peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id 
											  having count(peer_results.peer_id)>1) as p group by p.peer_survey_id, p.group_id"),
                                              array("surveyId"=>$surveyId));
							
							$company=Auth::User()->company()->first();
							$company_profile=$company->profile()->first();
							
							
							//This returns the minimum and maximum average per indicator group in this survey
							$surveyScoreGroupAvgPerIndicatorGroupMinAndMax = DB::select(DB::raw(
                                "SELECT d.Survey_ID, d.Indicator_Group_ID, d.Indicator_Group,
									MIN(d.Indicator_Group_Average) as Minimum_User_Indicator_Group_Average ,
									MAX(d.Indicator_Group_Average) as Maximum_User_Indicator_Group_Average FROM
										(select p.id, p.peer_survey_id as Survey_ID, p.user_id as User_ID, p.group_id as Indicator_Group_ID, p.name as Indicator_Group, avg(p.Indicator_Group_Average) as Indicator_Group_Average from 
											  (select peer_results.id, peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id, 
											  indicators.indicator, indicators.group_id, indicator_groups.name, avg(peer_results.answer) as Indicator_Group_Average 
											  from `peer_results`
											  join indicators on indicators.id = peer_results.indicator_id
											  join indicator_groups on indicator_groups.id = indicators.group_id
											  where peer_results.peer_survey_id = :surveyId group by 
											  peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id 
											  having count(peer_results.peer_id)>1) as p group by p.peer_survey_id, p.user_id, p.group_id)
								AS d GROUP BY d.Indicator_Group_ID"),
                                array("surveyId"=>$surveyId));
							
							
							$answers = DB::select(DB::raw(
									"select users.id, users.name, users.email from users where users.id in
										(select p.user_id from (select peer_results.id, peer_results.peer_survey_id, 
												peer_results.user_id, peer_results.indicator_id, count(peer_results.peer_id) 
												from `peer_results` where peer_results.peer_survey_id = :surveyId group by 
												peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id 
												having count(peer_results.peer_id)>1) as p group by p.user_id)"),
											array("surveyId"=>$surveyId));
					
						  

                            return view('survey.resultForIndividualInAdmin')->with('survey',Survey::find($surveyId))
                            ->with(['surveyScoreAllUsers' => $surveyScoreAllUsers])
                            ->with(['surveyScoreAllUsersCheckThreeParticipants' => $surveyScoreAllUsersCheckThreeParticipants])
							->with(['surveyGroupAveragePerIndicatorAllUsers' => $surveyGroupAveragePerIndicatorAllUsers])
                            ->with(['surveyScorePerIndicatorGroup' => $surveyScorePerIndicatorGroup])
                            ->with(['surveyScoreGroupAvgPerIndicatorGroup' => $surveyScoreGroupAvgPerIndicatorGroup])
                            ->with('participants',Survey::find($surveyId)->participants)
                            ->with('user',$userId)
							->with('company',$company)
						    ->with('company_profile',$company->profile()->first())
						    ->with(['surveyScoreGroupAvgPerIndicatorGroupMinAndMax' => $surveyScoreGroupAvgPerIndicatorGroupMinAndMax])
							->with('answers',count($answers));
				//}
	}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editSurvey($id) {
		$survey = Survey::find($id);
		if($this->SurveyType($id)=='self'){
			$surveys = DB::table('surveys')->where('id',$id)->where('user_id',Auth::User()->id)->get();
			if(!empty($surveys)){
				$indicators = Indicator::all();
				$participantsCompleted = DB::select(DB::raw(
									"select users.id, users.name, users.email from users where users.id in 
										(select participants.user_id from participants 
											where participants.survey_id = :surveyId and participants.completed = 1)"),
										array("surveyId"=>$id));
										
				$participantsNotCompleted = DB::select(DB::raw(
									"select users.id, users.name, users.email from users where users.id in 
										(select participants.user_id from participants 
											where participants.survey_id = :surveyId and participants.completed != 1)"),
										array("surveyId"=>$id));
				
				//These are the ones who have not been invited to take part in the survey						
				$participantsNot = DB::select(DB::raw(
									"select p.id, p.name, p.email from
											(select users.id, users.name, users.email from users where users.company_id = :companyId and users.id not in
											(select surveys.user_id from surveys where surveys.id = :surveyId1)) as p
											where p.id not in 
											(select participants.user_id from participants where participants.survey_id = :surveyId)and p.id 
										in (select role_user.user_id from role_user where role_user.role_id != 0)"),
										array("surveyId1"=>$id,"companyId"=>Auth::User()->company_id,"surveyId"=>$id));

				
				return view('survey.editAdmin')
						->with('survey',$survey)
						->with('indicators',$indicators)
						->with('participantsNot',$participantsNot)
						->with('participantsNotCompleted',$participantsNotCompleted)
						->with('participantsCompleted',$participantsCompleted);
			}
		
		}else{//This is peer evaluation
			$surveys = DB::table('surveys')->where('id',$id)->where('user_id',Auth::User()->id)->get();
			if(!empty($surveys)){
				$indicators = Indicator::all();
				$participantsCompleted = DB::select(DB::raw(
									"select users.id, users.name, users.email from users where users.id in 
										(select p.user_id from (select peer_results.id, peer_results.peer_survey_id, 
												peer_results.user_id, peer_results.indicator_id, count(peer_results.peer_id) 
												from `peer_results` where peer_results.peer_survey_id = :surveyId group by 
												peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id 
												having count(peer_results.peer_id)>1) as p group by p.user_id)"),
										array("surveyId"=>$id));
										
				/*$participantsNotCompletedss = DB::select(DB::raw(
									"select users.id, users.name, users.email from users where users.id in 
										(select participants.user_id from participants 
											where participants.survey_id = :surveyId1 and participants.user_id != :currentUser
											and participants.user_id not in
										(select p.user_id from (select peer_results.id, peer_results.peer_survey_id, 
												peer_results.user_id, peer_results.indicator_id, count(peer_results.peer_id) 
												from `peer_results` where peer_results.peer_survey_id = :surveyId group by 
												peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id 
												having count(peer_results.peer_id)>1) as p group by p.user_id))"),
										array("surveyId1"=>$id,"surveyId"=>$id,"currentUser"=>Auth::User()->id));*/
										
				$participantsNotCompleted = DB::select(DB::raw(
									"select users.id, users.name, users.email from users where users.id in 
										(select participants.user_id from participants 
											where participants.survey_id = :surveyId
											and participants.completed = 0 and participants.user_id not in
										(select distinct peer_results.user_id from peer_results where peer_results.peer_survey_id = :surveyId1)
                                         and participants.user_id not in
                                         (select distinct peer_results.peer_id from peer_results where peer_results.peer_survey_id = :surveyId2)
                                         and participants.user_id not in
                                        (select distinct peer_surveys.user_id from peer_surveys where peer_surveys.survey_id = :surveyId3)
                                        and participants.user_id not in 
                                        (select distinct peer_surveys.peer_id from peer_surveys where peer_surveys.survey_id = :surveyId4))"),
										array("surveyId"=>$id,"surveyId1"=>$id,"surveyId2"=>$id,"surveyId3"=>$id,"surveyId4"=>$id));
				
				
				//These are the ones who have not been invited to take part in the survey						
				$participantsNot = DB::select(DB::raw(
									"select p.id, p.name, p.email from
											(select users.id, users.name, users.email from users where users.company_id = :companyId and users.id not in
											(select surveys.user_id from surveys where surveys.id = :surveyId1)) as p
											where p.id not in 
											(select participants.user_id from participants where participants.survey_id = :surveyId)and p.id 
										in (select role_user.user_id from role_user where role_user.role_id != 0)"),
										array("surveyId1"=>$id,"companyId"=>Auth::User()->company_id,"surveyId"=>$id));

				
				return view('survey.editAdmin')
						->with('survey',$survey)
						->with('indicators',$indicators)
						->with('participantsNot',$participantsNot)
						->with('participantsNotCompleted',$participantsNotCompleted)
						->with('participantsCompleted',$participantsCompleted);
		}

    }
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	 //It assumes the data we receive from the client browser is what we expect to a certain degree, otherwise we would have to do another database query
	 //to ascertain that the data matches which again would assume that the database server trusts us and that the data we send can be verified as existent
	 //and likewise we trust that the feedback came from our intended database server, etc, etc
    public function updateSurvey(Request $request){
		$companyTimeZone = DB::table('company_profiles')->where('id',Auth::User()->company_id)->value('time_zone');
		$survey = Survey::find($request->id);
        $validation=Validator::make($request->all(),[
            'title'=>'required|max:255',
            'editor1'=>'required|max:10000',
            'survey_type'=>'required',
            'editor2'=>'required|max:500'

        ]);
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }else{
			DB::beginTransaction();
			try{
			if(!empty($request->date)){
				$date=explode('-',$request->date);
				$from=new Carbon($date[0]);
				$to=new Carbon($date[1]);
				
				if($from<Carbon::now($companyTimeZone) || $to<Carbon::now($companyTimeZone)){
					return redirect()->back()
                    ->with('fail','The Survey open and close date should not be before the current date and time. Your company timezone was set to: '.$companyTimeZone)
                    ->withInput();
				}
				
				DB::table('surveys')
							->where('id',$request->id)
							->update([
								'title'=>$request->title,
								'description'=>$request->editor1,
								'end_message'=>$request->editor2,
								'type_id'=>$request->survey_type,
								'start_time'=>$from,
								'end_time'=>$to,
								'updated_at'=>Carbon::now()
					]);
			}else{
				DB::table('surveys')
							->where('id',$request->id)
							->update([
								'title'=>$request->title,
								'description'=>$request->editor1,
								'end_message'=>$request->editor2,
								'type_id'=>$request->survey_type,
								'updated_at'=>Carbon::now()
					]);
			}
            
			if(!empty($request->usersToRemove)){
               foreach($request->usersToRemove as $user){
					DB::table('participants')
						->where('user_id', $user)
						->where('survey_id', $request->id)
						->delete();
						$userEmail = DB::table('users')->where('id',$user)->value('email');
						$this->email('email.deleteParticipant',['owner'=>$owner=Auth::User()->name,'name'=>User::find($user)->name, 'link'=>url('/').'/login', 'title'=>$survey->title],$userEmail);
				}
			}
			
			if(!empty($request->usersToAdd)){
				foreach($request->usersToAdd as $user){
					DB::table('participants')
						->insert([
							'survey_id'=>$request->id,
							'user_id'=>$user,
							'updated_at'=>Carbon::now()
						]);
						$userEmail = DB::table('users')->where('id',$user)->value('email');
						$this->email('email.editsurvey',['owner'=>$owner=Auth::User()->name, 'link'=>url('/').'/login','name'=>User::find($user)->name, 'title'=>$survey->title],$userEmail);
				}
			}
            DB::commit();
			
            return Redirect::to('admin')->with('success','The survey has been updated successfully.
                 The survey will be open to the participants on the open date you have specified. Also, you can view the complete result of the survey once it is closed ');
           }catch(\Exception $e){
				DB::rollback();
				return "An error occured; your request could not be completed ".$e->getMessage();
			}
        }

    }

	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteSurvey($id){
		$survey = Survey::find($id);
		if(empty($survey)){
			return Redirect::to('admin')->with('warning','That Survey does not exist.');
		}
		$type = $survey->type_id;
		if($survey->user_id != Auth::User()->id){
			return Redirect::to('admin')->with('warning','You do not have the permission to delete this survey because you did not create it.');
		}
		DB::beginTransaction();
		try{
		if ($type == 1) {
					DB::delete(DB::raw(
									"delete from results where results.survey_id = :surveyId and results.survey_id is not null"),
										array("surveyId"=>$id));
						
					DB::delete(DB::raw(
									"delete from participants where participants.survey_id = :surveyId and participants.survey_id is not null"),
										array("surveyId"=>$id));
						
					DB::delete(DB::raw(
									"delete from surveys where surveys.id = :surveyId"),
										array("surveyId"=>$id));
					DB::commit();
					return Redirect::to('admin')->with('success','The Survey with title: '.$survey->title.' and id: '.$survey->id.' was deleted successfully.');
		}
		if ($type == 2) {
					DB::delete(DB::raw(
									"delete from peer_results where peer_results.peer_survey_id = :surveyId and peer_results.peer_survey_id is not null"),
										array("surveyId"=>$id));
						
					DB::delete(DB::raw(
									"delete from peer_surveys where peer_surveys.survey_id = :surveyId and peer_surveys.survey_id is not null"),
										array("surveyId"=>$id));
						
					DB::delete(DB::raw(
									"delete from participants where participants.survey_id = :surveyId and participants.survey_id is not null"),
										array("surveyId"=>$id));
						
					DB::delete(DB::raw(
									"delete from surveys where surveys.id = :surveyId"),
										array("surveyId"=>$id));
				DB::commit();
				return Redirect::to('admin')->with('success','The Survey with title: '.$survey->title.' and id: '.$survey->id.' was deleted successfully.');
			}
		}catch(\Exception $e){
				DB::rollback();
				return "An error occured; your request could not be completed ".$e->getMessage();
			}
		}
    
	public function SurveyType($id)
    {
        if (Survey_Type::find(Survey::find($id)->type_id)->name == 'peer survey') {
            return 'peer';
        } else {
            return 'self';
        }
    }
	
    public function ValidateSurvey($id){

      if(Company::find(Auth::user()->company_id)->hasSurveys()->where('id',$id)->exists()){

          if(User::find(Survey::find($id)->user_id)->hasRole('admin')){
              return 'true';
          }else{
              return 'false';
          }

        }

}

    public function SurveyStatus($id){
        $survey=Survey::find($id);
        if($survey->start_time < Carbon::now()->addHour(1) && $survey->end_time > Carbon::now()->addHour(1) ){
            return 'open';
        }
        elseif($survey->start_time < Carbon::now()->addHour(1) && $survey->end_time < Carbon::now()->addHour(1)){
            return 'closed';
        }else{
            return 'pending';
        }
    }
}
