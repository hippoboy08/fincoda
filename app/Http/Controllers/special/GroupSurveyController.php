<?php

namespace App\Http\Controllers\special;

use App\Http\Controllers\EmailTrait;
use App\Indicator;
use App\Survey;
use App\User;
use App\Survey_Type;
use App\User_Group;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Http\Response;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Worksheet;
use View;
use PDF;



class GroupSurveyController extends Controller
{
	use EmailTrait;
    public function index(){
		$companyTimeZone = DB::table('company_profiles')->where('id',Auth::User()->company_id)->value('time_zone');
		$open = DB::table('surveys')
							->join('user_groups','user_groups.id','=','surveys.user_group_id')
							->select('surveys.id','surveys.user_id','surveys.type_id','surveys.company_id','surveys.category_id',
							'surveys.user_group_id','surveys.title','surveys.description','surveys.end_message','surveys.start_time',
							'surveys.end_time','surveys.created_at','surveys.updated_at')
							->where('surveys.company_id',Auth::User()->company_id)
							->where('surveys.user_id',Auth::User()->id)
							->where('user_groups.administrator','=',Auth::User()->id)
							->where('surveys.start_time','<',Carbon::now($companyTimeZone))
							->where('surveys.end_time','>',Carbon::now($companyTimeZone))
							->where('surveys.category_id',2)->get();
		
		//This status looks to be redundant without much activity defined in it: A survey seems to have activity when its either open or closed.				
		$pending = DB::table('surveys')
							->join('user_groups','user_groups.id','=','surveys.user_group_id')
							->select('surveys.id','surveys.user_id','surveys.type_id','surveys.company_id','surveys.category_id',
							'surveys.user_group_id','surveys.title','surveys.description','surveys.end_message','surveys.start_time',
							'surveys.end_time','surveys.created_at','surveys.updated_at')
							->where('surveys.company_id',Auth::User()->company_id)
							->where('surveys.user_id',Auth::User()->id)
							->where('user_groups.administrator','=',Auth::User()->id)
							->where('surveys.start_time','>',Carbon::now($companyTimeZone))
							->where('surveys.end_time','>',Carbon::now($companyTimeZone))
							->where('surveys.category_id',2)->get();
							
		$closed = DB::table('surveys')
							->join('user_groups','user_groups.id','=','surveys.user_group_id')
							->select('surveys.id','surveys.user_id','surveys.type_id','surveys.company_id','surveys.category_id',
							'surveys.user_group_id','surveys.title','surveys.description','surveys.end_message','surveys.start_time',
							'surveys.end_time','surveys.created_at','surveys.updated_at')
							->where('surveys.company_id',Auth::User()->company_id)
							->where('user_groups.administrator','=',Auth::User()->id)
							->where('surveys.user_id',Auth::User()->id)
							->where('surveys.start_time','<',Carbon::now($companyTimeZone))
							->where('surveys.end_time','<',Carbon::now($companyTimeZone))
							->where('surveys.category_id',2)->get();
		
        return view('dashboard')->with('open',$open)->with('closed',$closed)->with('pending',$pending);

    }

    public function create(){
		$group = DB::table('user_groups')
							->where('company_id',Auth::User()->company_id)
							->where('administrator','=',Auth::id())
							->lists('user_groups.name','user_groups.id');

        return view('survey.createSpecial')
			->with('groups',$group)
            ->with('indicators',Indicator::all())
            ->with('participants',DB::table('users')
                ->join('role_user','role_user.user_id','=','users.id')
                ->where('role_id','=',3)
                ->join('user_in_groups','user_in_groups.user_id','=','users.id')
                ->join('user_groups','user_groups.id','=','user_in_groups.user_group_id')
                ->join('companies','companies.id','=','users.company_id')
                ->where('companies.id','=',Auth::User()->company_id)
                ->where('user_groups.administrator','=',Auth::id())
                ->get());

    }
	
	//All the functions that persist data to the model should be reviewed
        public function store(Request $request)
        {
			$companyTimeZone = DB::table('company_profiles')->where('id',Auth::User()->company_id)->value('time_zone');
			$validation=Validator::make($request->all(),[
                'title'=>'required|max:255',
                'editor1'=>'required|max:500',
                'date'=>'required',
                'survey_type'=>'required',
                'group'=>'required',
                'editor2'=>'required|max:500'

            ]);
			$owner=Auth::User();
			$participants = DB::select(DB::raw(
									"select user_in_groups.user_id from user_in_groups where user_in_groups.user_group_id = :groupId and user_in_groups.user_id != :owner "),
										array("groupId"=>$request->group,"owner"=>$owner->id));
			
			
			if($request->survey_type == 2 && $request->numberOfEvaluators < 1){
			    return redirect()->back()
                    ->with('fail','You need to provide the number of evaluators for your peer survey: It cannot be zero')
                    ->withInput();
            }
			
			if($request->survey_type == 2 && $request->numberOfEvaluators == count($participants)){
				return redirect()->back()
					->with('fail','The number of evaluators for your peer survey cannot equal the number of participants in the survey')
					->withInput();
			}
		
			if($request->survey_type == 2 && $request->numberOfEvaluators > count($participants)){
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
			
				//The date management still needs to be worked on especially at 24:00 or 12:00 AM
               if($from<Carbon::now($companyTimeZone) || $to<Carbon::now($companyTimeZone)){
                    return redirect()->back()
                        ->with('fail','The Survey open and close date should not be before the current date and time. Please fix the date range before creating the survey.')
                        ->withInput();
                }else{
					DB::beginTransaction();
					try{
						$survey=$owner->creates_survey()->create([
							'title'=>$request->title,
							'description'=>$request->editor1,
							'number_of_evaluators'=>$request->numberOfEvaluators,
							'end_message'=>$request->editor2,
							'user_id'=>$owner->id,
							'type_id'=>$request->survey_type,
							'company_id'=>Auth::User()->company_id,
							'category_id'=>2,
							'user_group_id'=>(int)$request->group,
							'start_time'=>$from,
							'end_time'=>$to
					]);

					
					if(!empty($participants)){
						foreach($participants as $user){
							DB::table('participants')
								->insert([
									'survey_id'=>$survey->id,
									'user_id'=>$user->user_id,
									'created_at'=>Carbon::now(),
									'updated_at'=>Carbon::now()
								]);
							$userEmail = DB::table('users')->where('id',$user->user_id)->value('email');
							$this->email('email.newsurvey',['owner'=>$owner=Auth::User()->name, 'link'=>url('/').'/login',
							     'title'=>$survey->title,'start_time'=>$from,'end_time'=>$to],$userEmail);
						}
					}
					 DB::commit();
					//This piece of code was inherited 
                    //$this->email('email.newsurvey',['owner'=>$owner->name, 'title'=>$survey->title],$member_email);

                    return Redirect::to('special/groupsurvey')->with('success','The survey has been created successfully.
                 The survey will be open to the participants on the open date you have specified. Also, you can view the complete result of the survey once it is closed ');
               
			}catch(\Exception $e){
				DB::rollback();
				return "An error occured; your request could not be completed ".$e->getMessage();
			}
            }

			}

        }
		
		
	public function switchLanguage(Request $request){
		return response()->json(array('stri'=>'success'));
	}
		

		public function lookForGroupMembers(Request $request){
					$members = DB::table('users')
							->join('role_user','role_user.user_id','=','users.id')
							->join('user_in_groups','user_in_groups.user_id','=','users.id')
							->select('users.id as user_id','users.name','users.email')
							->where('company_id',Auth::User()->company_id)
							->where('role_user.role_id','=',3)
							->where('user_in_groups.user_group_id','=',$request['groupId'])
							->get();

					return response()->json(array('stri'=>$request['groupId']));
		}


	//Notes: Ajax does a post but knows nothing about rendering complex blades smoothly without using complex code
	//To achieve smooth redirection in a simple way you have to call a route in the ajax window.replace function
	//A sensible approach here would be to get post results, put them in private variables and then use them in a function
	//that serves the desired blade through a get route other than a post route
	//That approach failed as the variables were not available in the next function call
	//A new approach had to be adapted as below in other words post through ajax
	// and then parameter passing via routes

	public function lookForParticipant(Request $request){
		$selectedUserIdGroupId = explode("|",$request['participantId']);
		$participantId = $selectedUserIdGroupId[0];
		$surveyId = $request['surveyId'];
		$groupId = $selectedUserIdGroupId[1];
		$newRoute = "getParticipant/";
		$newRoute .= $surveyId;
		$newRoute .= "/";
		$newRoute .= $groupId;
		$newRoute .= "/";
		$newRoute .= $participantId;
        return response()->json(array('stri'=>$newRoute,'strin'=>$participantId));
	}

	public function getParticipant($surveyId, $groupId, $participantId){
		return $this->getParticipantDetails($surveyId, $groupId, $participantId);

    }

	
	
	//This is the download pdf function: It could look that we should do a dedicated function since the queries look the same; but the problem is that we are dealing with an app that has dynamically
	//evolving requirements subject to change at any time: at one point they may look similar enough to be grouped into a clearly known function, but at another instance
	//they may change and you find yourself refactoring or rewriting to separate them out.
	public function downloadPdf($id){
		try{
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
				
				
				$view = PDF::loadview('survey.resultForSpecialPdfOverview',compact('survey','surveyScoreAllUsers','surveyGroupAveragePerIndicatorAllUsers',
									'surveyScorePerIndicatorGroup','surveyScoreGroupAvgPerIndicatorGroup','surveyScoreGroupAvgPerIndicatorGroupMinAndMax',
									'participants','company','company_profile','answers'));
				//$pdf = \App::make('dompdf.wrapper');
				//$pdf->loadHTML($view);
				return $view->inline();
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
				
				$view = PDF::loadview('survey.resultForSpecialPdfOverview',
												compact('survey','$surveyScoreAllUsersCheckThreeParticipants','surveyScoreAllUsers',
															'surveyGroupAveragePerIndicatorAllUsers','surveyScorePerIndicatorGroup',
															'surveyScoreGroupAvgPerIndicatorGroup','surveyScoreGroupAvgPerIndicatorGroupMinAndMax',
															'participants','company','company_profile','answers'));
				//$pdf = \App::make('dompdf.wrapper');
				//$pdf->loadHTML($view);
				return $view->inline();		}
		
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
			  $surveyScoreGroupAvgPerIndicatorGroupMinAndMax = DB::select(DB::raw(
                            "SELECT p.Group_ID, p.Survey_ID, p.Indicator_Group_ID, p.Indicator_Group,
									MIN(p.Indicator_Group_Average) as Minimum_User_Indicator_Group_Average ,
									MAX(p.Indicator_Group_Average) as Maximum_User_Indicator_Group_Average FROM
										(SELECT user_in_groups.user_group_id as Group_ID, results.survey_id as Survey_ID,
                                            results.user_id as User_ID, indicators.group_id as Indicator_Group_ID,
                                            indicator_groups.name as Indicator_Group,
                                            AVG(results.answer) as Indicator_Group_Average
                                            FROM indicators
                                            JOIN results on results.indicator_id = indicators.id
                                            JOIN indicator_groups on indicators.group_id = indicator_groups.id
                                            JOIN user_in_groups on results.user_id = user_in_groups.user_id
                                            WHERE results.survey_id = :surveyId
                                            GROUP BY results.survey_id, user_in_groups.user_group_id, results.user_id, indicators.group_id)
									AS p GROUP BY p.Survey_ID, p.Group_ID, p.Indicator_Group_ID"),
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

    public function show($id){
        if($this->ValidateSurvey($id)){
            if($this->SurveyStatus($id)=='pending'){
                $this->editSurvey($id);
            }else{//Its assumed that in this function only group surveys will be handled or given as parameters
              //Its also assumed that only Surveys belonging to the concerned special user will be given as parameters
              //The function should return the results of the survey in the group
				if ($this->SurveyType($id) == 'self') {
					$participants = DB::select(DB::raw(
                            "select users.id as User_ID, users.name, users.email from users where users.id in 
														(select participants.user_id from participants 
															where participants.survey_id = :surveyId)"),
                            array("surveyId"=>$id));


                    $surveyScoreAllUsers = DB::select(DB::raw(
                            "select results.survey_id as Survey_ID, 
								results.user_id as User_ID, indicators.id as Indicator_ID,
								indicators.indicator as Indicator, results.answer as Answer,
								indicators.group_id as Indicator_Group_ID, indicator_groups.name as Indicator_Group
								from indicators
								join results on results.indicator_id = indicators.id
								join indicator_groups on indicators.group_id = indicator_groups.id
								where results.survey_id = :surveyId
								group by results.survey_id, results.user_id, indicators.id"),
                            array("surveyId"=>$id));


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
                            "select results.survey_id as Survey_ID, 
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

					//This returns the average of each user per indicator group for this survey
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

                    return view('survey.resultForSpecialGroupSurvey')->with('survey',Survey::find($id))
                    ->with(['surveyScoreAllUsers' => $surveyScoreAllUsers])
                    ->with(['surveyGroupAveragePerIndicatorAllUsers' => $surveyGroupAveragePerIndicatorAllUsers])
                    ->with(['surveyScorePerIndicatorGroup' => $surveyScorePerIndicatorGroup])
                    ->with(['surveyScoreGroupAvgPerIndicatorGroup' => $surveyScoreGroupAvgPerIndicatorGroup])
                    ->with('participants',$participants)
					->with('company',$company)
					->with('company_profile',$company->profile()->first())
                    ->with(['surveyScoreGroupAvgPerIndicatorGroupMinAndMax' => $surveyScoreGroupAvgPerIndicatorGroupMinAndMax])
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
												
							//This returns the participants that were invited to take part in the peer survey 
							$participants = DB::select(DB::raw(
							 					"select users.id as User_ID, users.name, users.email from users where users.id in 
														(select participants.user_id from participants 
															where participants.survey_id = :surveyId)"),
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
					
						  

                            return view('survey.resultForSpecialGroupSurvey')->with('survey',Survey::find($id))
                            ->with(['surveyScoreAllUsers' => $surveyScoreAllUsers])
                            ->with(['surveyScoreAllUsersCheckThreeParticipants' => $surveyScoreAllUsersCheckThreeParticipants])
							->with(['surveyGroupAveragePerIndicatorAllUsers' => $surveyGroupAveragePerIndicatorAllUsers])
                            ->with(['surveyScorePerIndicatorGroup' => $surveyScorePerIndicatorGroup])
                            ->with(['surveyScoreGroupAvgPerIndicatorGroup' => $surveyScoreGroupAvgPerIndicatorGroup])
                            ->with('participants',$participants)
                            ->with('company',$company)
						    ->with('company_profile',$company->profile()->first())
						    ->with(['surveyScoreGroupAvgPerIndicatorGroupMinAndMax' => $surveyScoreGroupAvgPerIndicatorGroupMinAndMax])
							->with('answers',$answers);
		  }
			}

        }else{
            return view('errors.404')->with('title',' Survey Not found')
                ->with('message','The survey you requested doe not belong to your company/does not exists in the Fincoda Survey System or you do not have permission to access it.');
        }


    }


	public function getParticipantDetails($surveyId, $groupId, $participantId){
	  $id = $surveyId;
      $userId = $participantId;
	  $groupId = $groupId;
	  if($this->ValidateSurvey($id)=='true'){
          if($this->SurveyStatus($id)=='pending'){
              $this->editSurvey($id);
          }else{
              //This returns the indicator scores for each user that took part in the survey
              //Used native or raw queries because laravel has no support for listed grouping on aggregate functions
              //In other words it will always return a single result
			if ($this->SurveyType($id) == 'self') {
			  $surveyScoreAllUsersCheckThreeParticipants = DB::table('results')
                                              ->select('results.user_id as User_ID')
                                              ->where('results.survey_id',$id)
                                              ->distinct()->get();

											  						  
			  $participantsSelect = DB::select(DB::raw(
                            "select results.survey_id as Survey_ID, user_in_groups.user_group_id as Group_ID,
								results.user_id as User_ID, users.name as name,
								users.email as email, participants.reminder as reminder,
                                participants.completed as completed
                                from indicators
								join results on results.indicator_id = indicators.id
								join users on results.user_id = users.id
								join participants on results.user_id = participants.user_id
								join user_in_groups on results.user_id = user_in_groups.user_id
								join indicator_groups on indicators.group_id = indicator_groups.id
								where results.survey_id = :surveyId
								and user_in_groups.user_group_id = :groupId
								group by results.survey_id, user_in_groups.user_group_id, results.user_id"),
                            array("surveyId"=>$id,"groupId"=>$groupId));



				$participants = DB::select(DB::raw(
                            "select users.id as User_ID, users.name, users.email from users where users.id in 
														(select participants.user_id from participants 
															where participants.survey_id = :surveyId)"),
                            array("surveyId"=>$id));

              //If a user does not belong to any group, then this query will return an empty result set
			  $surveyScoreAllUsers = DB::select(DB::raw(
                            "select results.survey_id as Survey_ID, user_in_groups.user_group_id as Group_ID,
								results.user_id as User_ID, indicators.id as Indicator_ID,
								indicators.indicator as Indicator, results.answer as Answer,
								indicators.group_id as Indicator_Group_ID, indicator_groups.name as Indicator_Group
								from indicators
								join results on results.indicator_id = indicators.id
								join user_in_groups on results.user_id = user_in_groups.user_id
								join indicator_groups on indicators.group_id = indicator_groups.id
								where results.survey_id = :surveyId
								and results.user_id = :userId
								and user_in_groups.user_group_id = :groupId
								group by results.survey_id, user_in_groups.user_group_id, results.user_id, indicators.id"),
                            array("surveyId"=>$id,"userId"=>$userId,"groupId"=>$groupId));


                    //This returns the average of the user group per indicator in this survey
                    $surveyGroupAveragePerIndicatorAllUsers = DB::select(DB::raw(
                            "SELECT results.survey_id as Survey_ID, user_in_groups.user_group_id as Group_ID,
                            indicators.id as Indicator_ID, indicators.indicator as Indicator,
                            AVG(results.answer) as Group_Average
                            FROM indicators
                            join results on results.indicator_id = indicators.id
                            join user_in_groups on results.user_id = user_in_groups.user_id
                            WHERE results.survey_id = :surveyId
                            and user_in_groups.user_group_id = :groupId
							GROUP BY results.survey_id, user_in_groups.user_group_id, indicators.id"),
                            array("surveyId"=>$id,"groupId"=>$groupId));

                     //This returns the average of each user per indicator group for this survey
                    $surveyScoreGroupAvgPerIndicatorGroup = DB::select(DB::raw(
                            "SELECT results.survey_id as Survey_ID, user_in_groups.user_group_id as Group_ID,
                            results.user_id as User_ID, indicators.group_id as Indicator_Group_ID,
                            indicator_groups.name as Indicator_Group,
                            AVG(results.answer) as Indicator_Group_Average
                            FROM indicators
                            JOIN results on results.indicator_id = indicators.id
                            JOIN indicator_groups on indicators.group_id = indicator_groups.id
                            JOIN user_in_groups on results.user_id = user_in_groups.user_id
                            WHERE results.survey_id = :surveyId
                            and user_in_groups.user_group_id = :groupId
							GROUP BY results.survey_id, user_in_groups.user_group_id, results.user_id, indicators.group_id"),
                            array("surveyId"=>$id,"groupId"=>$groupId));

                    //This returns the average of each user group per indicator group in this survey
                    $surveyScorePerIndicatorGroup = DB::select(DB::raw(
                            "SELECT results.survey_id as Survey_ID, user_in_groups.user_group_id as Group_ID,
                            indicators.group_id as Indicator_Group_ID,
                            indicator_groups.name as Indicator_Group,
                            AVG(results.answer) as Indicator_Group_Average
                            FROM indicators
                            JOIN results on results.indicator_id = indicators.id
                            JOIN indicator_groups on indicators.group_id = indicator_groups.id
                            JOIN user_in_groups on results.user_id = user_in_groups.user_id
                            WHERE results.survey_id = :surveyId
                            and user_in_groups.user_group_id = :groupId
							GROUP BY results.survey_id, user_in_groups.user_group_id, indicators.group_id"),
                            array("surveyId"=>$id,"groupId"=>$groupId));


					//This returns the average of each user per indicator group for this survey
                    $surveyScoreGroupAvgPerIndicatorGroupMinAndMax = DB::select(DB::raw(
                            "SELECT p.Group_ID, p.Survey_ID, p.Indicator_Group_ID, p.Indicator_Group,
									MIN(p.Indicator_Group_Average) as Minimum_User_Indicator_Group_Average ,
									MAX(p.Indicator_Group_Average) as Maximum_User_Indicator_Group_Average FROM
										(SELECT user_in_groups.user_group_id as Group_ID, results.survey_id as Survey_ID,
                                            results.user_id as User_ID, indicators.group_id as Indicator_Group_ID,
                                            indicator_groups.name as Indicator_Group,
                                            AVG(results.answer) as Indicator_Group_Average
                                            FROM indicators
                                            JOIN results on results.indicator_id = indicators.id
                                            JOIN indicator_groups on indicators.group_id = indicator_groups.id
                                            JOIN user_in_groups on results.user_id = user_in_groups.user_id
                                            WHERE results.survey_id = :surveyId
                                            and user_in_groups.user_group_id = :groupId
											GROUP BY results.survey_id, user_in_groups.user_group_id, results.user_id, indicators.group_id)
									AS p GROUP BY p.Survey_ID, p.Group_ID, p.Indicator_Group_ID"),
                             array("surveyId"=>$id,"groupId"=>$groupId));

              $company=Auth::User()->company()->first();
              $company_profile=$company->profile()->first();
			  
			  $answers = DB::select(DB::raw(
									"select users.id, users.name, users.email from users where users.id in 
										(select participants.user_id from participants 
											where participants.survey_id = :surveyId and participants.completed=1)"),
										array("surveyId"=>$id));

              return view('survey.resultForIndividualInSpecial')->with('survey',Survey::find($id))
              ->with(['surveyScoreAllUsers' => $surveyScoreAllUsers])
              ->with(['surveyGroupAveragePerIndicatorAllUsers' => $surveyGroupAveragePerIndicatorAllUsers])
              ->with(['surveyScorePerIndicatorGroup' => $surveyScorePerIndicatorGroup])
              ->with(['surveyScoreGroupAvgPerIndicatorGroup' => $surveyScoreGroupAvgPerIndicatorGroup])
              ->with(['surveyScoreAllUsersCheckThreeParticipants' => $surveyScoreAllUsersCheckThreeParticipants])
			  ->with('participants',$participants)
              ->with('participantsSelect',$participantsSelect)
              ->with('company',$company)
              ->with('user',$userId)
              ->with('company_profile',$company->profile()->first())

              ->with(['surveyScoreGroupAvgPerIndicatorGroupMinAndMax' => $surveyScoreGroupAvgPerIndicatorGroupMinAndMax])

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
											  
							//This returns the participants that were invited to take part in the peer survey 
							$participants = DB::select(DB::raw(
									"select users.id as User_ID, users.name, users.email from users where users.id in 
										(select participants.user_id from participants 
											where participants.survey_id = :surveyId)"),
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
												array("surveyId"=>$surveyId,"userId"=>$participantId));


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
					
						  

                            return view('survey.resultForIndividualInSpecial')->with('survey',Survey::find($id))
                            ->with(['surveyScoreAllUsers' => $surveyScoreAllUsers])
                            ->with(['surveyScoreAllUsersCheckThreeParticipants' => $surveyScoreAllUsersCheckThreeParticipants])
							->with(['surveyGroupAveragePerIndicatorAllUsers' => $surveyGroupAveragePerIndicatorAllUsers])
                            ->with(['surveyScorePerIndicatorGroup' => $surveyScorePerIndicatorGroup])
                            ->with(['surveyScoreGroupAvgPerIndicatorGroup' => $surveyScoreGroupAvgPerIndicatorGroup])
                            ->with('participants',$participants)
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

	
	/**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editSurvey($id)
    {
		$survey = Survey::find($id);
		$indicators = Indicator::all();
		//This check helps us verify if the returned survey id to edit actually falls under any of the groups the current logged in user
		//manages or administers
		$group = DB::table('user_groups')
							->where('company_id',Auth::User()->company_id)
							->where('administrator','=',Auth::id())
							->where('id','=',$survey->user_group_id)
							->lists('user_groups.name','user_groups.id');
							
		if(empty($group)){
			return ('fail: The Survey you tried to open may not be under any of the groups you manage.');
		}					
		
		$surveyGroupName = User_Group::find($survey->user_group_id)->name;
		
		if($this->SurveyType($id)=='self'){
			$surveys = DB::table('surveys')->where('id',$id)->where('user_id',Auth::User()->id)->get();//Check if this is the owner of the survey
			if(!empty($surveys)){
					$group = DB::table('user_groups')
										->where('company_id',Auth::User()->company_id)
										->where('administrator','=',Auth::id())
										->orderByRaw("CASE WHEN user_groups.name='$surveyGroupName' THEN -1 ELSE user_groups.name END")
										->lists('user_groups.name','user_groups.id');
					
					$participantsCompleted = DB::select(DB::raw(
										"select users.id, users.name, users.email from users where users.id in 
											(select participants.user_id from participants
											 join user_in_groups on participants.user_id = user_in_groups.user_id
											 join surveys on participants.survey_id = surveys.id
											 where user_in_groups.user_group_id = :userGroupId
											 and surveys.user_group_id = :surveyGroupId
											 and participants.survey_id = :surveyId
											 and participants.completed = 1)"),
											array("userGroupId"=>$survey->user_group_id,"surveyGroupId"=>$survey->user_group_id, "surveyId"=>$id));
											
					$participantsNotCompleted = DB::select(DB::raw(
										"select users.id, users.name, users.email from users where users.id in 
											(select participants.user_id from participants
											 join user_in_groups on participants.user_id = user_in_groups.user_id
											 join surveys on participants.survey_id = surveys.id
											 where user_in_groups.user_group_id = :userGroupId
											 and surveys.user_group_id = :surveyGroupId
											 and participants.survey_id = :surveyId
											 and participants.completed != 1)"),
											array("userGroupId"=>$survey->user_group_id,"surveyGroupId"=>$survey->user_group_id, "surveyId"=>$id));
					
					
					$participantsNot = DB::select(DB::raw(
									"select users.id, users.name, users.email from users where users.company_id = :companyId 
										and users.id in (select user_in_groups.user_id from `user_in_groups` 
										where user_in_groups.user_group_id = (select surveys.user_group_id from surveys where surveys.id = :surveyId2))
										and users.id not in (select surveys.user_id from surveys where surveys.id = :surveyId1) and users.id not in
										(select participants.user_id from participants where participants.survey_id = :surveyId) and users.id 
										in (select role_user.user_id from role_user where role_user.role_id = 3)"),
										array("surveyId1"=>$id,"companyId"=>Auth::User()->company_id,"surveyId"=>$id,"surveyId2"=>$id));
										
					
					return view('survey.editSpecial')
							->with('survey',$survey)
							->with('groups',$group)
							->with('indicators',$indicators)
							->with('participantsNot',$participantsNot)
							->with('participantsNotCompleted',$participantsNotCompleted)
							->with('participantsCompleted',$participantsCompleted);
				
	}}else{//This is peer evaluation
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
										
				$participantsNotCompleted = DB::select(DB::raw(
									"select users.id, users.name, users.email from users where users.id in 
										(select participants.user_id from participants 
											where participants.survey_id = :surveyId1 and participants.user_id != :currentUser
											and participants.user_id not in
										(select p.user_id from (select peer_results.id, peer_results.peer_survey_id, 
												peer_results.user_id, peer_results.indicator_id, count(peer_results.peer_id) 
												from `peer_results` where peer_results.peer_survey_id = :surveyId group by 
												peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id 
												having count(peer_results.peer_id)>1) as p group by p.user_id))"),
										array("surveyId1"=>$id,"surveyId"=>$id,"currentUser"=>Auth::User()->id));
				
				//These are the ones who have not been invited to take part in the survey						
				$participantsNot = DB::select(DB::raw(
									"select users.id, users.name, users.email from users where users.company_id = :companyId 
										and users.id in (select user_in_groups.user_id from `user_in_groups` 
										where user_in_groups.user_group_id = (select surveys.user_group_id from surveys where surveys.id = :surveyId2))
										and users.id not in (select surveys.user_id from surveys where surveys.id = :surveyId1) and users.id not in
										(select participants.user_id from participants where participants.survey_id = :surveyId)and users.id 
										in (select role_user.user_id from role_user where role_user.role_id = 3)"),
										array("surveyId1"=>$id,"companyId"=>Auth::User()->company_id,"surveyId"=>$id,"surveyId2"=>$id));
				
				return view('survey.editSpecial')
						->with('survey',$survey)
						->with('groups',$group)
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
    public function updateSurvey(Request $request){
		
		$companyTimeZone = DB::table('company_profiles')->where('id',Auth::User()->company_id)->value('time_zone');
		$survey = Survey::find($request->id);
        $validation=Validator::make($request->all(),[
            'title'=>'required|max:255',
            'editor1'=>'required|max:500',
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
                    ->with('fail','The Survey open and close date should not be before the current date and time. Your company time zone was set to: '.$companyTimeZone)
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
								'type_id'=>$request->survey_type
					]);
			}
            	
			if(!empty($request->usersToRemove)){
					$owner=Auth::User();
					$participants = DB::select(DB::raw(
											"select user_in_groups.user_id from user_in_groups where user_in_groups.user_group_id = :groupId and user_in_groups.user_id != :owner "),
												array("groupId"=>$survey->user_group_id,"owner"=>$owner->id));
					
					if($request->survey_type == 2){
						if(count($participants)-count($request->usersToRemove)<6){
								return redirect()->back()
									->with('fail','The group needs to have at least six members for a peer survey.')
									->withInput();
						}
					}
				
				   foreach($request->usersToRemove as $user){
						DB::table('participants')
							->where('user_id', $user)
							->where('survey_id', $request->id)
							->delete();
							$userEmail = DB::table('users')->where('id',$user)->value('email');
							$this->email('email.deleteParticipant',['owner'=>$owner=Auth::User()->name, 'link'=>url('/').'/login', 'title'=>$survey->title],$userEmail);
					}
			}
			if(!empty($request->usersToAdd)){
				foreach($request->usersToAdd as $user){
					$userExistsInGroup = DB::table('user_in_groups')->where('user_id',$user)->where('user_group_id',$survey->user_group_id)->value('user_id');
					if(empty($userExistsInGroup)){
						continue;
					}
					DB::table('participants')
						->insert([
							'survey_id'=>$request->id,
							'user_id'=>$user,
							'updated_at'=>Carbon::now()
						]);
						$userEmail = DB::table('users')->where('id',$user)->value('email');
						$this->email('email.newsurvey',['owner'=>$owner=Auth::User()->name, 'link'=>url('/').'/login', 'title'=>$survey->title],$userEmail);
				}
			}
            DB::commit();
			
            return Redirect::to('special/groupsurvey')->with('success','The survey has been updated successfully.
                 The survey will be open to the participants on the open date you have specified. Also, you can view the complete result of the survey once it is closed ');
           
		   }catch(\Exception $e){
				DB::rollback();
				return "An error occured; your request could not be completed ".$e->getMessage();
			}
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
	
	 /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteSurvey($id){
		$survey = Survey::find($id);
		if(empty($survey)){
			return Redirect::to('special')->with('warning','That Survey does not exist.');
		}
		$type = $survey->type_id;
		if($survey->user_id != Auth::User()->id){
			return Redirect::to('special')->with('warning','You do not have the permission to delete this survey because you did not create it.');
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
					return Redirect::to('special')->with('success','The Survey with title: '.$survey->title.' and id: '.$survey->id.' was deleted successfully.');
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
				return Redirect::to('special/groupsurvey')->with('success','The Survey with title: '.$survey->title.' and id: '.$survey->id.' was deleted successfully.');
			}
		}catch(\Exception $e){
				DB::rollback();
				return "An error occured; your request could not be completed ".$e->getMessage();
			}
		}

    public function ValidateSurvey($id){
		if(empty((Survey::find($id)->user_group_id))||(Survey::find($id)->user_group_id)<1){
			return false;
		}
        if(Auth::User()->creates_survey()->where('id',$id)->exists()){
        return true;
        }else{
            return false;
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
