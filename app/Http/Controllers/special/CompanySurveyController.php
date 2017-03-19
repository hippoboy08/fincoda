<?php

namespace App\Http\Controllers\special;
use App\Http\Controllers\EmailTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Company;
use App\Survey;
use App\Survey_Type;
use App\Indicator;
use App\Result;
use App\User;
use App\Participant;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Session;

class CompanySurveyController extends Controller
{
	use EmailTrait;
	public function index(){
            $companyTimeZone = DB::table('company_profiles')->where('id',Auth::User()->company_id)->value('time_zone');
			$open = Auth::User()->company->hasSurveys()->where('start_time', '<', Carbon::now($companyTimeZone))->where('end_time', '>', Carbon::now($companyTimeZone))->select('id')->get();

        $completed_survey = DB::table('participants')->whereIn('survey_id', $open)->where('participants.user_id', Auth::id())->where('completed', 1)->join('surveys', 'surveys.id', '=', 'participants.survey_id')
            ->select('surveys.id', 'surveys.type_id', 'surveys.start_time', 'surveys.end_time', 'surveys.user_id', 'surveys.title', 'surveys.title', 'participants.completed')
            ->get();
        $closed = Auth::User()->company->hasSurveys()->where('start_time', '<', Carbon::now($companyTimeZone))->where('end_time', '<', Carbon::now($companyTimeZone))->select('id')->get();
        $closed_survey = DB::table('participants')->whereIn('survey_id', $closed)->where('participants.user_id', Auth::id())->join('surveys', 'surveys.id', '=', 'participants.survey_id')
            ->select('surveys.id', 'surveys.type_id', 'surveys.start_time', 'surveys.end_time', 'surveys.user_id', 'surveys.title', 'surveys.title', 'participants.completed')
            ->get();

        return view('survey.complete')->with('completed', $completed_survey)->with('closed', $closed_survey);
    }
	
	
	public function switchLanguage(Request $request){
		return response()->json(array('stri'=>'success'));
	}

    public function show($id){
      $email = Auth::user()->email;
      $userId = DB::table('users')->where('email',$email)->value('id');
      if ($this->ValidateSurvey($id) == 'true') {
            if ($this->SurveyStatus($id) == 'open') {
                if(Auth::User()->participate_survey()->where('survey_id',$id)->first()->completed==1){//This is the status when five have evaluated someone
                    if ($this->SurveyType($id) == 'self') {//This case can only occur when the special user takes a company survey
                      //Here its still an open survey but he has already participated in it and so wants to see his results
                            //This returns the indicator scores for each user that took part in the survey
                            //Used native or raw queries because laravel has no support for listed grouping on aggregate functions
                            //In other words it will always return a single result
							
							$surveyScoreAllUsersCheckThreeParticipants = DB::table('results')
                                              ->select('results.user_id as User_ID')
                                              ->where('results.survey_id',$id)
                                              ->distinct()->get();
							
                            $surveyScoreAllUsers = DB::table('indicators')
                                              ->join('results','results.indicator_id','=','indicators.id')
                                              ->join('indicator_groups','indicators.group_id','=','indicator_groups.id')
                                              ->select('results.survey_id as Survey_ID',
                                                       'results.user_id as User_ID','indicators.id as Indicator_ID',
                                                       'indicators.indicator as Indicator', 'results.answer as Answer',
                                                       'indicators.group_id as Indicator_Group_ID','indicator_groups.name as Indicator_Group')
                                              ->where('results.survey_id',$id)
                                              ->where('results.user_id',$userId)
                                              ->groupBy('results.survey_id', 'results.user_id', 'indicators.id')
                                              ->get();


                            //This returns the average of the user group per indicator in this survey
                            $surveyGroupAveragePerIndicatorAllUsers = DB::select(DB::raw(
                                              "SELECT results.survey_id as Survey_ID,
                                              indicators.id as Indicator_ID, indicators.indicator as Indicator,
                                              ROUND (AVG(results.answer), 2) as Group_Average
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
                                              ROUND(AVG(results.answer), 2) as Indicator_Group_Average
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
                                              ROUND(AVG(results.answer), 2) as Indicator_Group_Average
                                              FROM indicators
                                              JOIN results on results.indicator_id = indicators.id
                                              JOIN indicator_groups on indicators.group_id = indicator_groups.id
                                              WHERE results.survey_id = :surveyId
                                              GROUP BY results.survey_id, indicators.group_id"),
                                              array("surveyId"=>$id));
							
							
							//This is a company survey in which the special user participated so has no access to minimum and 
							//And maximum averages: only the admin has access to that
							$surveyScoreGroupAvgPerIndicatorGroupMinAndMax = [];
					
						  

                            return view('survey.resultForSpecialInCompanySurvey')->with('survey',Survey::find($id))
                            ->with(['surveyScoreAllUsers' => $surveyScoreAllUsers])
                            ->with(['surveyScoreAllUsersCheckThreeParticipants' => $surveyScoreAllUsersCheckThreeParticipants])
							->with(['surveyGroupAveragePerIndicatorAllUsers' => $surveyGroupAveragePerIndicatorAllUsers])
                            ->with(['surveyScorePerIndicatorGroup' => $surveyScorePerIndicatorGroup])
                            ->with(['surveyScoreGroupAvgPerIndicatorGroup' => $surveyScoreGroupAvgPerIndicatorGroup])
                            ->with('participants',Survey::find($id)->participants)
                            ->with(['surveyScoreGroupAvgPerIndicatorGroupMinAndMax' => $surveyScoreGroupAvgPerIndicatorGroupMinAndMax])
							->with('answers',count(Survey::find($id)->participants()->where('completed',1)->get()));
                    } else {
							//this is peer results
							//In the peer survey results check if more than one peer have evaluated this user_id
							$evaluatorsCompleted = DB::select(DB::raw(
									"select users.id, users.name, users.email from users where users.id in
										(select peer_results.peer_id from peer_results where peer_results.peer_survey_id = :surveyId 
											and peer_results.user_id = :currentUser)"),
											array("surveyId"=>$id,"currentUser"=>Auth::User()->id));
											
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
												array("surveyId"=>$id,"userId"=>Auth::User()->id));


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
							
							
							//This is a company survey in which the special user participated so has no access to minimum and 
							//And maximum averages: only the admin has access to that
							$surveyScoreGroupAvgPerIndicatorGroupMinAndMax = [];
							
							
							$answers = DB::select(DB::raw(
									"select users.id, users.name, users.email from users where users.id in
										(select p.user_id from (select peer_results.id, peer_results.peer_survey_id, 
												peer_results.user_id, peer_results.indicator_id, count(peer_results.peer_id) 
												from `peer_results` where peer_results.peer_survey_id = :surveyId group by 
												peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id 
												having count(peer_results.peer_id)>1) as p group by p.user_id)"),
											array("surveyId"=>$id));
					
						  

                            return view('survey.resultForSpecialInCompanySurvey')->with('survey',Survey::find($id))
                            ->with(['surveyScoreAllUsers' => $surveyScoreAllUsers])
                            ->with(['surveyScoreAllUsersCheckThreeParticipants' => $surveyScoreAllUsersCheckThreeParticipants])
							->with(['surveyGroupAveragePerIndicatorAllUsers' => $surveyGroupAveragePerIndicatorAllUsers])
                            ->with(['surveyScorePerIndicatorGroup' => $surveyScorePerIndicatorGroup])
                            ->with(['surveyScoreGroupAvgPerIndicatorGroup' => $surveyScoreGroupAvgPerIndicatorGroup])
                            ->with('participants',Survey::find($id)->participants)
                            ->with(['surveyScoreGroupAvgPerIndicatorGroupMinAndMax' => $surveyScoreGroupAvgPerIndicatorGroupMinAndMax])
							->with('answers',count($answers));
                    }

                } else {
                    if ($this->SurveyType($id) == 'self') {
						$profileStatus = DB::table('user_profiles')->where('user_id',Auth::user()->id)->value('complete');
						if($profileStatus==0){
							return view('profile.edituser')->with('profile',Auth::User()->profile)->with('user',Auth::User());
						}
						if($profileStatus==1){
							return view('survey.answer')->with('indicators', Indicator::all())
                            ->with('survey', Survey::find($id));
						}
                        
                    } else {
                     //Check if the logged in user was invited to take part in the survey
						$participant = DB::select(DB::raw(
                            "select users.id, users.name, users.email from users where users.id in 
								(select participants.user_id from participants 
									where participants.survey_id = :surveyId and participants.user_id = :currentUser)"),
								array("surveyId"=>$id,"currentUser"=>Auth::User()->id));
							
								
						if(!empty($participant)){//This means the logged in user was invited to participate in this survey
							
								//This returns the participants that were invited to take part in the peer survey excluding the current logged in user
								//because is the one to invite evaluators and cannot evaluate him or herself
								$participant = DB::select(DB::raw(
									"select users.id, users.name, users.email from users where users.id in 
										(select participants.user_id from participants 
											where participants.survey_id = :surveyId and participants.user_id != :currentUser)"),
										array("surveyId"=>$id,"currentUser"=>Auth::User()->id));
									
								//This returns the evaluators for this survey that the current logged in user selected
								$evaluators = DB::select(DB::raw(
									"select users.id, users.name, users.email from users where users.id in 
										(select peer_surveys.peer_id from peer_surveys 
											where peer_surveys.survey_id = :surveyId and peer_surveys.user_id = :currentUser)"),
										array("surveyId"=>$id,"currentUser"=>Auth::User()->id));
										
										
								//This returns of the invitees ones who completed the survey
								$evaluatorsCompleted = DB::select(DB::raw(
									"select users.id, users.name, users.email from users where users.id in
										(select peer_results.peer_id from peer_results where peer_results.peer_survey_id = :surveyId 
											and peer_results.user_id = :currentUser)"),
											array("surveyId"=>$id,"currentUser"=>Auth::User()->id));
											
								//This returns of the invitees ones who have not yet completed the survey		
								$evaluatorsNotCompleted = DB::select(DB::raw(
									"select users.id, users.name, users.email from users where users.id in
										(select peer_surveys.peer_id from peer_surveys 
											where peer_surveys.survey_id = :surveyId1 and peer_surveys.user_id = :currentUser1 and peer_surveys.peer_id not in
												(select peer_results.peer_id from peer_results where peer_results.peer_survey_id = :surveyId 
											and peer_results.user_id = :currentUser))"),
											array("surveyId1"=>$id,"surveyId"=>$id,"currentUser1"=>Auth::User()->id,"currentUser"=>Auth::User()->id));
											
								//This selects all participants the logged in user is supposed to evaluate in this survey
								$evaluatees = DB::select(DB::raw(
									"select users.id, users.name, users.email from users where users.id in 
										(select peer_surveys.user_id from peer_surveys 
											where peer_surveys.survey_id = :surveyId and peer_surveys.peer_id = :currentUser)"),
										array("surveyId"=>$id,"currentUser"=>Auth::User()->id));
										
										
								//This selects all participants the logged in user has evaluated in this survey
								$evaluated = DB::select(DB::raw(
									"select users.id, users.name, users.email from users where users.id in 
										(select peer_results.user_id from peer_results 
											where peer_results.peer_survey_id = :surveyId and peer_results.peer_id = :currentUser)"),
										array("surveyId"=>$id,"currentUser"=>Auth::User()->id));
										
								//This selects all participants the logged in user has not yet evaluated in this survey
								$evaluatedNot = DB::select(DB::raw(
									"select users.id, users.name, users.email from users where users.id in
										(select peer_surveys.user_id from peer_surveys 
											where peer_surveys.survey_id = :surveyId1 and peer_surveys.peer_id = :currentUser1 and peer_surveys.user_id not in
										(select peer_results.user_id from peer_results 
											where peer_results.peer_survey_id = :surveyId and peer_results.peer_id = :currentUser))"),
										array("surveyId1"=>$id,"surveyId"=>$id,"currentUser1"=>Auth::User()->id,"currentUser"=>Auth::User()->id));
										
									
								//This returns the evaluators for this survey that the current logged in user has not selected to evaluate him or her
								$participantsNotSelectedAsEvaluators = DB::select(DB::raw(
									"select users.id, users.name, users.email from users where users.id in 
									(select participants.user_id from participants 
											where participants.survey_id = :surveyId1 and participants.user_id != :currentUser1 and users.id not in
									(select users.id from users where users.id in 
										(select peer_surveys.peer_id from peer_surveys 
											where peer_surveys.survey_id = :surveyId and peer_surveys.user_id = :currentUser)))"),
										array("surveyId"=>$id,"surveyId1"=>$id,"currentUser"=>Auth::User()->id,"currentUser1"=>Auth::User()->id));
											
								
								//The computer is a procedural flow machine such that if we manage to get here, then the logged in user needs to select
								//evaluators or view ones that have completed
								$profileStatus = DB::table('user_profiles')->where('user_id',Auth::user()->id)->value('complete');
								if($profileStatus==0){
									return view('profile.edituser')->with('profile',Auth::User()->profile)->with('user',Auth::User());
								}
								if($profileStatus==1){
									return view('survey.peerSelectEvaluators')
										->with('participants', $participant)
										->with('participantsNotSelectedAsEvaluators', $participantsNotSelectedAsEvaluators)
										->with('evaluators', $evaluators)
										->with('evaluatees', $evaluatees)
										->with('evaluatedNot', $evaluatedNot)
										->with('evaluated', $evaluated)
										->with('evaluatorsCompleted', $evaluatorsCompleted)
										->with('evaluatorsNotCompleted', $evaluatorsNotCompleted)
										->with('user', Auth::User()->name)
										->with('survey', Survey::find($id));
								}
						}
                    }

                }

            } elseif ($this->SurveyStatus($id) == 'closed') {
                if(Auth::User()->participate_survey()->where('survey_id',$id)->first()->completed==1
						||Auth::User()->participate_survey()->where('survey_id',$id)->first()->completed==3 //This status is if more than one person have evaluated someone in the peer survey
								||Auth::User()->participate_survey()->where('survey_id',$id)->first()->completed==5){//This is the status when five have evaluated someone
                    if ($this->SurveyType($id) == 'self') {//This is a company scoped survey and the case when the survey is closed
                      //And a special user has taken it because it appears in his list of closed surveys
                      //but now wants to see his report
                            //This returns the indicator scores for each user that took part in the survey
                            //Used native or raw queries because laravel has no support for listed grouping on aggregate functions
                            //In other words it will always return a single result
							
							$surveyScoreAllUsersCheckThreeParticipants = DB::table('results')
                                              ->select('results.user_id as User_ID')
                                              ->where('results.survey_id',$id)
                                              ->distinct()->get();
							
							
                            $surveyScoreAllUsers = DB::table('indicators')
                                              ->join('results','results.indicator_id','=','indicators.id')
                                              ->join('indicator_groups','indicators.group_id','=','indicator_groups.id')
                                              ->select('results.survey_id as Survey_ID',
                                                       'results.user_id as User_ID','indicators.id as Indicator_ID',
                                                       'indicators.indicator as Indicator', 'results.answer as Answer',
                                                       'indicators.group_id as Indicator_Group_ID','indicator_groups.name as Indicator_Group')
                                              ->where('results.survey_id',$id)
                                              ->where('results.user_id',$userId)
                                              ->groupBy('results.survey_id', 'results.user_id', 'indicators.id')
                                              ->get();

                            //This returns the average of the user group per indicator in this survey
                            $surveyGroupAveragePerIndicatorAllUsers = DB::select(DB::raw(
                                              "SELECT results.survey_id as Survey_ID,
                                              indicators.id as Indicator_ID, indicators.indicator as Indicator,
                                              ROUND (AVG(results.answer), 2) as Group_Average
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
                                              ROUND(AVG(results.answer), 2) as Indicator_Group_Average
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
                                              ROUND(AVG(results.answer), 2) as Indicator_Group_Average
                                              FROM indicators
                                              JOIN results on results.indicator_id = indicators.id
                                              JOIN indicator_groups on indicators.group_id = indicator_groups.id
                                              WHERE results.survey_id = :surveyId
                                              GROUP BY results.survey_id, indicators.group_id"),
                                              array("surveyId"=>$id));
											  
											  
							//This is a company survey in which the special user participated so has no access to minimum and 
							//And maximum averages: only the admin has access to that
							$surveyScoreGroupAvgPerIndicatorGroupMinAndMax = [];
					
							
							

                            return view('survey.resultForSpecialInCompanySurvey')->with('survey',Survey::find($id))
                            ->with(['surveyScoreAllUsers' => $surveyScoreAllUsers])
                            ->with(['surveyScoreAllUsersCheckThreeParticipants' => $surveyScoreAllUsersCheckThreeParticipants])
							->with(['surveyGroupAveragePerIndicatorAllUsers' => $surveyGroupAveragePerIndicatorAllUsers])
                            ->with(['surveyScorePerIndicatorGroup' => $surveyScorePerIndicatorGroup])
                            ->with(['surveyScoreGroupAvgPerIndicatorGroup' => $surveyScoreGroupAvgPerIndicatorGroup])
                            ->with(['surveyScoreGroupAvgPerIndicatorGroupMinAndMax' => $surveyScoreGroupAvgPerIndicatorGroupMinAndMax])
							->with('participants',Survey::find($id)->participants)
                            ->with('answers',count(Survey::find($id)->participants()->where('completed',1)->get()));

                    } else {
						//This is peer results
                        //In the peer survey results check if more than one peer have evaluated this user_id
							$evaluatorsCompleted = DB::select(DB::raw(
									"select users.id, users.name, users.email from users where users.id in
										(select peer_results.peer_id from peer_results where peer_results.peer_survey_id = :surveyId 
											and peer_results.user_id = :currentUser)"),
											array("surveyId"=>$id,"currentUser"=>Auth::User()->id));
											
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
												array("surveyId"=>$id,"userId"=>Auth::User()->id));


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
							
							
							//This is a company survey in which the special user participated so has no access to minimum and 
							//And maximum averages: only the admin has access to that
							$surveyScoreGroupAvgPerIndicatorGroupMinAndMax = [];
							
							
							$answers = DB::select(DB::raw(
									"select users.id, users.name, users.email from users where users.id in
										(select p.user_id from (select peer_results.id, peer_results.peer_survey_id, 
												peer_results.user_id, peer_results.indicator_id, count(peer_results.peer_id) 
												from `peer_results` where peer_results.peer_survey_id = :surveyId group by 
												peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id 
												having count(peer_results.peer_id)>1) as p group by p.user_id)"),
											array("surveyId"=>$id));
					
						  

                            return view('survey.resultForSpecialInCompanySurvey')->with('survey',Survey::find($id))
                            ->with(['surveyScoreAllUsers' => $surveyScoreAllUsers])
                            ->with(['surveyScoreAllUsersCheckThreeParticipants' => $surveyScoreAllUsersCheckThreeParticipants])
							->with(['surveyGroupAveragePerIndicatorAllUsers' => $surveyGroupAveragePerIndicatorAllUsers])
                            ->with(['surveyScorePerIndicatorGroup' => $surveyScorePerIndicatorGroup])
                            ->with(['surveyScoreGroupAvgPerIndicatorGroup' => $surveyScoreGroupAvgPerIndicatorGroup])
                            ->with('participants',Survey::find($id)->participants)
                            ->with(['surveyScoreGroupAvgPerIndicatorGroupMinAndMax' => $surveyScoreGroupAvgPerIndicatorGroupMinAndMax])
							->with('answers',count($answers));
						
                    }
                } else {
                    return view('errors.404')->with('title', ' Unable to open Survey Result')
                        ->with('message', 'The result you requested can not be displayed - You did not complete the survey');
                }
            } elseif ($this->SurveyStatus($id) == 'pending') {
                return view('errors.404')->with('title', ' Unable to open survey')
                    ->with('message', 'The survey you requested can not be open - it is not yet open for the participants');
            }


        } else {
            return view('errors.404')->with('title', ' Survey not found.')
                ->with('message', 'The survey you requested does not belong to your company or does not exist in Fincoda Survey System.');
        }
    }
	
	
	public function inviteEvaluators(Request $request){
		    $companyTimeZone = DB::table('company_profiles')->where('id',Auth::User()->company_id)->value('time_zone');
			$survey = Survey::find($request->survey_id);
		//dd($request->all());
		//This is for incremental additions, but in this case the additions are still strict to 5
        $participantsNotSelectedAsEvaluators = DB::select(DB::raw(
			"select users.id, users.name, users.email from users where users.id in 
			(select participants.user_id from participants 
					where participants.survey_id = :surveyId1 and participants.user_id != :currentUser1 and users.id not in
			(select users.id from users where users.id in 
				(select peer_surveys.peer_id from peer_surveys 
					where peer_surveys.survey_id = :surveyId and peer_surveys.user_id = :currentUser)))"),
				array("surveyId"=>$request->survey_id,"surveyId1"=>$request->survey_id,"currentUser"=>Auth::User()->id,"currentUser1"=>Auth::User()->id));
										
        if(count($request->usersToEvaluate)!==$survey->number_of_evaluators){
			Session::flash('message','You need to select '.$survey->number_of_evaluators.' users to evaluate you');
            return redirect()->back();
        }else{
			
			if(!empty($request->usersToEvaluate)){
			DB::beginTransaction();
			try{
				foreach($request->usersToEvaluate as $user){
					DB::table('peer_surveys')
						->insert([
							'survey_id'=>$request->survey_id,
							'peer_id'=>$user,
							'user_id'=>Auth::User()->id,
							'created_at'=>Carbon::now($companyTimeZone),
							'updated_at'=>Carbon::now($companyTimeZone)
						]);
						$userEmail = DB::table('users')->where('id',$user)->value('email');
						$this->email('email.peerEvaluators',['owner'=>Auth::User()->name, 'link'=>url('/').'/login','name'=>User::find($user)->name, 'title'=>Survey::find($request->survey_id)->title],$userEmail);
				}
				DB::commit();
				return redirect()->back()
                    ->with('success','Your  request has been completed ');
				}catch(\Exception $e){
				DB::rollback();
				return "An error occured; your request could not be completed ".$e->getMessage();
			}
			}
			}
		
			
    }
	
	public function evaluateUser($surveyId, $userId){
		//This selects all participants the logged in user has not yet evaluated in this survey
		$evaluatedNot = DB::select(DB::raw(
			"select users.id, users.name, users.email from users where users.id = $userId and users.id in
				(select peer_surveys.user_id from peer_surveys 
					where peer_surveys.survey_id = :surveyId1 and peer_surveys.peer_id = :currentUser1 and peer_surveys.user_id not in
				(select peer_results.user_id from peer_results 
					where peer_results.peer_survey_id = :surveyId and peer_results.peer_id = :currentUser))"),
				array("surveyId1"=>$surveyId,"surveyId"=>$surveyId,"currentUser1"=>Auth::User()->id,"currentUser"=>Auth::User()->id));
				
		if(count($evaluatedNot)>0){
						$profileStatus = DB::table('user_profiles')->where('user_id',Auth::user()->id)->value('complete');
						if($profileStatus==0){
							return view('profile.edituser')->with('profile',Auth::User()->profile)->with('user',Auth::User());
						}
						if($profileStatus==1){
							return view('survey.answer')
								->with('indicators', Indicator::all())
								->with('user_id', $userId)
								->with('survey', Survey::find($surveyId));
						}
		}
		return Redirect::to('special/survey/'.$surveyId)->with('success','Your have no users to evaluate');
			
	}
	
	
	public function viewPeerResults($surveyId, $userId){
							//In the peer survey results check if more than one peer have evaluated this user_id
							$evaluatorsCompleted = DB::select(DB::raw(
									"select users.id, users.name, users.email from users where users.id in
										(select peer_results.peer_id from peer_results where peer_results.peer_survey_id = :surveyId 
											and peer_results.user_id = :currentUser)"),
											array("surveyId"=>$surveyId,"currentUser"=>Auth::User()->id));
											
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
												array("surveyId"=>$surveyId,"userId"=>Auth::User()->id));


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
							
							
							//This is a company survey in which the special user participated so has no access to minimum and 
							//And maximum averages: only the admin has access to that
							$surveyScoreGroupAvgPerIndicatorGroupMinAndMax = [];
							
							
							$answers = DB::select(DB::raw(
									"select users.id, users.name, users.email from users where users.id in
										(select p.user_id from (select peer_results.id, peer_results.peer_survey_id, 
												peer_results.user_id, peer_results.indicator_id, count(peer_results.peer_id) 
												from `peer_results` where peer_results.peer_survey_id = :surveyId group by 
												peer_results.peer_survey_id, peer_results.user_id, peer_results.indicator_id 
												having count(peer_results.peer_id)>1) as p group by p.user_id)"),
											array("surveyId"=>$surveyId));
					
						  

                            return view('survey.resultForSpecialInCompanySurvey')->with('survey',Survey::find($surveyId))
                            ->with(['surveyScoreAllUsers' => $surveyScoreAllUsers])
                            ->with(['surveyScoreAllUsersCheckThreeParticipants' => $surveyScoreAllUsersCheckThreeParticipants])
							->with(['surveyGroupAveragePerIndicatorAllUsers' => $surveyGroupAveragePerIndicatorAllUsers])
                            ->with(['surveyScorePerIndicatorGroup' => $surveyScorePerIndicatorGroup])
                            ->with(['surveyScoreGroupAvgPerIndicatorGroup' => $surveyScoreGroupAvgPerIndicatorGroup])
                            ->with('participants',Survey::find($surveyId)->participants)
                            ->with(['surveyScoreGroupAvgPerIndicatorGroupMinAndMax' => $surveyScoreGroupAvgPerIndicatorGroupMinAndMax])
							->with('answers',count($answers));
				
	}
	

    public function ValidateSurvey($id)
    {
        if (Company::find(Auth::User()->company_id)->hasSurveys()->where('id', $id)->exists()) {
            return true;
        } else {
            return false;
        }
    }

    public function SurveyStatus($id){
            $companyTimeZone = DB::table('company_profiles')->where('id',Auth::User()->company_id)->value('time_zone');
			if (Survey::find($id)->start_time < Carbon::now($companyTimeZone) && Survey::find($id)->end_time > Carbon::now($companyTimeZone)) {
            return 'open';
        } elseif (Survey::find($id)->start_time < Carbon::now($companyTimeZone) && Survey::find($id)->end_time < Carbon::now($companyTimeZone)) {
            return 'closed';
        } else {
            return 'pending';
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

    public function store(Request $request){
        count($request->radio);
		$companyTimeZone = DB::table('company_profiles')->where('id',Auth::User()->company_id)->value('time_zone');

        if(count($request->radio)==count(Indicator::all())){
			DB::beginTransaction();
			try{
			if ($this->SurveyType($request->survey_id) == 'self') {
				for($i=1; $i<count($request->radio)+1; $i++){
					Result::create([
						'survey_id'=>$request->survey_id,
						'user_id'=>Auth::id(),
						'indicator_id'=>$i,
						'answer'=>$request->radio[$i]
					]);
				}
				$participant=Participant::where('user_id',Auth::id())->where('survey_id',$request->survey_id)->first();
				$answer=Participant::find($participant->id);
				$answer->survey_id=$request->survey_id;
				$answer->user_id=Auth::id();
				$answer->completed=1;
				$answer->save();
				DB::commit();
				return Redirect::to('special/survey')->with('success','Your answer has been saved. Thank you for answering the survey. The complete result can be viewed once the survey is completed. Also please take a moment to check your profile and ensure that its up to date ');
			}else{
				//This is a peer survey
				for($i=1; $i<count($request->radio)+1; $i++){
					DB::table('peer_results')
						->insert([
						'peer_survey_id'=>$request->survey_id,
						'peer_id'=>Auth::id(),
						'user_id'=>$request->user_id,
						'indicator_id'=>$i,
						'answer'=>$request->radio[$i]
					]);
				}
				
				DB::table('peer_surveys')
					->where('user_id',$request->user_id)
					->where('peer_id',Auth::id())
					->where('survey_id',$request->survey_id)
					    ->update([
						'peer_completed'=>1,
						'updated_at'=>Carbon::now($companyTimeZone)
					    ]);
				
				//In the peer survey results check if more than one peer have evaluated this user_id
				$evaluatorsCompleted = DB::select(DB::raw(
									"select users.id, users.name, users.email from users where users.id in
										(select peer_results.peer_id from peer_results where peer_results.peer_survey_id = :surveyId 
											and peer_results.user_id = :currentUser)"),
											array("surveyId"=>$request->survey_id,"currentUser"=>$request->user_id));
											
											
				if(count($evaluatorsCompleted)>1){
					DB::table('participants')
								->where('user_id',$request->user_id)
								->where('survey_id',$request->survey_id)
								->update([
									'completed'=>3,
									'updated_at'=>Carbon::now($companyTimeZone)
						]);
				}
				//This should have been set to 1 to mark it as complete, but its likely that the user can have other users to evaluate
				//meaning that we return not the result blade but the peer blade: however the initial logic used if else blocks and overlooked the
				//needs of the peer survey being a bit different from the self survey: retrofitting new logic to cater for this peculiarity requires
				//restructuring the if else blocks: so have left the status to always be in progess so that the peer blade is returned from which you can
				//do other things while the survey is still open
				$numberSurveyEvalutors = Survey::find($request->survey_id)->number_of_evaluators;
				if((count($evaluatorsCompleted)==$numberSurveyEvalutors)){
					DB::table('participants')
								->where('user_id',$request->user_id)
								->where('survey_id',$request->survey_id)
								->update([
									'completed'=>5,
									'updated_at'=>Carbon::now($companyTimeZone)
						]);
				}
				DB::commit();
				return Redirect::to('special/survey/'.$request->survey_id)->with('success','Your answer has been saved. Thank you for answering the survey. The complete result can be viewed once the survey is completed. Also please take a moment to check your profile and ensure that its up to date ');
			}
			
		}catch(\Exception $e){
				DB::rollback();
				return "An error occured; your request could not be completed ".$e->getMessage();
			}
        }else{
            return redirect()->back()->with('fail',' Could not save your answer. All the indicators have to be marked. Please check the unmarked indicator(s) and submit the survey again.')
                ->withInput();
        }
			
    }
	
}
