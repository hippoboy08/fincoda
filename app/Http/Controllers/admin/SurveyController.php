<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\EmailTrait;
use App\Indicator;
use App\Participant;
use App\Role_User;
use App\Survey;
use App\User;
use App\Company;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;


class SurveyController extends Controller
{

use EmailTrait;
    public function index()
    {
        return view('survey.index')->with('closed',Company::find(Auth::User()->company_id)->hasSurveys()->where('end_time','<',Carbon::now()->addHour(1))->get());
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
              ->where('role_id','!=',1)
                     ->where('company_id','=',Auth::User()->company_id)
                     ->get());

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		//dd($request->all());
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
                    'category_id'=>1,
                    'start_time'=>$from,
                    'end_time'=>$to
                ]);

                $participants=DB::table('users')->where('company_id',Auth::User()->company_id)
                    ->join('role_user','role_user.user_id','=','users.id')
                    ->where('role_user.role_id','!=',1)
                    ->where('role_user.user_id','!=',Auth::id())
                    ->select('users.id', 'email')->get();

                foreach($participants as $participant){
                    $survey->participants()->create([
                        'user_id'=>$participant->id
                    ]);
                }

                foreach($participants as $participant){
                    $member_email[]=$participant->email;
                }

                //send email to the participants
              $this->email('email.newsurvey',['owner'=>$owner->name, 'title'=>$survey->title],$member_email);



                return Redirect::to('admin')->with('success','Your survey has been created successfully.
                 The survey will be open to the participants on the open date you have specified. Also, you can view the complete result of the survey once it is closed ');

            }
            }




    }


	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){

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
              ->with('answers',count(Survey::find($id)->participants()->where('completed',1)->get()));
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
              ->with('answers',count(Survey::find($id)->participants()->where('completed',1)->get()));
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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

                return Redirect::to('admin')->with('success','The survey has been updated successfully.
                 The survey will be open to the participants on the open date you have specified. Also, you can view the complete result of the survey once it is closed ');


            }


        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
