<?php

namespace App\Http\Controllers\special;

use App\Http\Controllers\EmailTrait;
use App\Indicator;
use App\Survey;
use App\User;
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



class GroupSurveyController extends Controller
{
    use EmailTrait;
    public function index(){
        //group dashboard
    $open=Auth::User()->creates_survey()
        ->where('start_time','<',Carbon::now()->addHour(1))
        ->where('end_time','>',Carbon::now()->addHour(1))
        ->where('category_id',2)->get();
    $pending=Auth::User()->creates_survey()->
    where('start_time','>',Carbon::now()->addHour(1))
        ->where('end_time','>',Carbon::now()->addHour(1))
        ->where('category_id',2)->get();
    $closed=Auth::User()->creates_survey()
        ->where('start_time','<',Carbon::now()->addHour(1))
        ->where('end_time','<',Carbon::now()->addHour(1))
        ->where('category_id',2)->get();
        return view('dashboard')->with('open',$open)->with('closed',$closed)->with('pending',$pending);

    }

    public function create()
    {

        return view('survey.create')->with('indicators',Indicator::all())
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

        public function store(Request $request)
        {

            $validation=Validator::make($request->all(),[
                'title'=>'required|max:255',
                'editor1'=>'required|max:500',
                'date'=>'required',
                'survey_type'=>'required',
                'editor2'=>'required|max:500'

            ]);

            if($validation->fails()){
                return redirect()->back()->withErrors($validation)->withInput();
            }else{
                $date=explode('-',$request->date);
                $from=new Carbon($date[0]);
                $to=new Carbon($date[1]);

                if($from<Carbon::now()->addHour(1) || $to<Carbon::now()->addHour(1)){
                    return redirect()->back()
                        ->with('fail','The Survey open and close date should not be before the current date and time. Please fix the date range before creating the survey.')
                        ->withInput();
                }else{


                    $owner=Auth::User();
                    $survey=$owner->creates_survey()->create([
                        'title'=>$request->title,
                        'description'=>$request->editor1,
                        'end_message'=>$request->editor2,
                        'user_id'=>$owner->id,
                        'type_id'=>$request->survey_type,
                        'company_id'=>Auth::User()->company_id,
                        'category_id'=>2,
                        'start_time'=>$from,
                        'end_time'=>$to
                    ]);

                    $participants=User_Group::find(Auth::User()->group_administrator->id)->hasMembers;

                    for($i=0; $i<count($participants); $i++){

                        $survey->participants()->create([
                            'user_id'=>$participants[$i]->user_id
                        ]);

                    }


                    //send email to the participants
                    foreach($participants as $participant){
                        $member_email[]=User::find($participant->user_id)->email;
                    }

                    $this->email('email.newsurvey',['owner'=>$owner->name, 'title'=>$survey->title],$member_email);



                    return Redirect::to('special')->with('success','The survey has been created successfully.
                 The survey will be open to the participants on the open date you have specified. Also, you can view the complete result of the survey once it is closed ');

                }
            }




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
              return view('survey.update')->with('survey',Survey::find($id))
                  ->with('indicators',Indicator::all())
                  ->with('participants',Survey::find($id)->participants);
          }else{
              //This returns the indicator scores for each user that took part in the survey
              //Used native or raw queries because laravel has no support for listed grouping on aggregate functions
              //In other words it will always return a single result
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
			  foreach ($surveyScoreAllUsers as $surveyScoreAllUser){
				  $surveyScoreAllUsersArray[] = get_object_vars($surveyScoreAllUser);
			  }
			  $workBook->getSheet(2)->fromArray(
					$surveyScoreAllUsersArray,
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
                return view('survey.update')->with('survey',Survey::find($id))
                    ->with('indicators',Indicator::all())
                    ->with('participants',Survey::find($id)->participants);
            }else{//Its assumed that in this function only group surveys will be handled or given as parameters
              //Its also assumed that only Surveys belonging to the concerned special user will be given as parameters
              //The function should return the results of the survey in the group
				
					$participants = DB::select(DB::raw(
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
								group by results.survey_id, user_in_groups.user_group_id, results.user_id"),
                            array("surveyId"=>$id));
							
			  
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
								group by results.survey_id, user_in_groups.user_group_id, results.user_id, indicators.id"),
                            array("surveyId"=>$id));
					

                    //This returns the average of the user group per indicator in this survey
                    $surveyGroupAveragePerIndicatorAllUsers = DB::select(DB::raw(
                            "SELECT results.survey_id as Survey_ID, user_in_groups.user_group_id as Group_ID,
                            indicators.id as Indicator_ID, indicators.indicator as Indicator,
                            AVG(results.answer) as Group_Average
                            FROM indicators
                            join results on results.indicator_id = indicators.id
                            join user_in_groups on results.user_id = user_in_groups.user_id
                            WHERE results.survey_id = :surveyId
                            GROUP BY results.survey_id, user_in_groups.user_group_id, indicators.id"),
                            array("surveyId"=>$id));

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
                            GROUP BY results.survey_id, user_in_groups.user_group_id, results.user_id, indicators.group_id"),
                            array("surveyId"=>$id));

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
                            GROUP BY results.survey_id, user_in_groups.user_group_id, indicators.group_id"),
                            array("surveyId"=>$id));
							
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
                                            GROUP BY results.survey_id, user_in_groups.user_group_id, results.user_id, indicators.group_id)
									AS p GROUP BY p.Survey_ID, p.Group_ID, p.Indicator_Group_ID"),
                            array("surveyId"=>$id));


                    return view('survey.resultForSpecialGroupSurvey')->with('survey',Survey::find($id))
                    ->with(['surveyScoreAllUsers' => $surveyScoreAllUsers])
                    ->with(['surveyGroupAveragePerIndicatorAllUsers' => $surveyGroupAveragePerIndicatorAllUsers])
                    ->with(['surveyScorePerIndicatorGroup' => $surveyScorePerIndicatorGroup])
                    ->with(['surveyScoreGroupAvgPerIndicatorGroup' => $surveyScoreGroupAvgPerIndicatorGroup])
                    ->with('participants',$participants)
                    ->with(['surveyScoreGroupAvgPerIndicatorGroupMinAndMax' => $surveyScoreGroupAvgPerIndicatorGroupMinAndMax])
					->with('answers',count(Survey::find($id)->participants()->where('completed',1)->get()));
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
              return view('survey.update')->with('survey',Survey::find($id))
                  ->with('indicators',Indicator::all())
                  ->with('participants',Survey::find($id)->participants);
          }else{
              //This returns the indicator scores for each user that took part in the survey
              //Used native or raw queries because laravel has no support for listed grouping on aggregate functions
              //In other words it will always return a single result

			  $surveyScoreAllUsersCheckThreeParticipants = DB::table('results')
                                              ->select('results.user_id as User_ID')
                                              ->where('results.survey_id',$id)
                                              ->distinct()->get();
			  
			  $participants = DB::select(DB::raw(
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
								and results.user_id = :userId
								and user_in_groups.user_group_id = :groupId
								group by results.survey_id, user_in_groups.user_group_id, results.user_id"),
                            array("surveyId"=>$id,"userId"=>$userId,"groupId"=>$groupId));
			  
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

              return view('survey.resultForIndividualInSpecial')->with('survey',Survey::find($id))
              ->with(['surveyScoreAllUsers' => $surveyScoreAllUsers])
              ->with(['surveyGroupAveragePerIndicatorAllUsers' => $surveyGroupAveragePerIndicatorAllUsers])
              ->with(['surveyScorePerIndicatorGroup' => $surveyScorePerIndicatorGroup])
              ->with(['surveyScoreGroupAvgPerIndicatorGroup' => $surveyScoreGroupAvgPerIndicatorGroup])
              ->with(['surveyScoreAllUsersCheckThreeParticipants' => $surveyScoreAllUsersCheckThreeParticipants])
			  ->with('participants',$participants)
              ->with('company',$company)
              ->with('company_profile',$company->profile()->first())

              ->with(['surveyScoreGroupAvgPerIndicatorGroupMinAndMax' => $surveyScoreGroupAvgPerIndicatorGroupMinAndMax])

              ->with('answers',count(Survey::find($id)->participants()->where('completed',1)->get()));

          }

      }else{
          return view('errors.404')->with('title',' Survey Not found')
              ->with('message','The survey you requested doe not belong to your company or does not exists in the Fincoda Survey System.');
      }

    }


    public function update(Request $request,$id){
        $validation=Validator::make($request->all(),[
            'title'=>'required|max:255',
            'editor1'=>'required|max:500',
            'date'=>'required',
            'survey_type'=>'required',
            'editor2'=>'required|max:500'

        ]);
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }
        else{

            $date=explode('-',$request->date);
            $from=new Carbon($date[0]);
            $to=new Carbon($date[1]);

            if($from<Carbon::now()->addHour(1) || $to<Carbon::now()->addHour(1)){
                return redirect()->back()
                    ->with('fail','The Survey open and close date should not be before the current date and time. Please fix the date range before creating the survey.')
                    ->withInput();
            }else{
                $survey=Survey::find($id);
                $survey->title=$request->title;
                $survey->description=$request->editor1;
                $survey->end_message=$request->editor2;
                $survey->type_id=$request->survey_type;
                $survey->start_time=$from;
                $survey->end_time=$to;
                $survey->save();

                return Redirect::to('special/survey')->with('success','The survey has been updated successfully.
                 The survey will be open to the participants on the open date you have specified. Also, you can view the complete result of the survey once it is closed. ');


            }


        }
    }


    public function ValidateSurvey($id){

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
