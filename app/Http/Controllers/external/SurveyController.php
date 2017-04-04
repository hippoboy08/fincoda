<?php

namespace App\Http\Controllers\external;
use App\Http\Controllers\EmailTrait;
use App\Company;
use App\Indicator;
use App\Participant;
use App\Result;
use App\Survey;
use App\Survey_Type;
use App\User;
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
use Session;

class SurveyController extends Controller
{
	use EmailTrait;
    public function index(){
		$companyTimeZone = DB::table('company_profiles')->where('id',Auth::User()->company_id)->value('time_zone');
        $open=Company::find(Auth::User()->company_id)->hasSurveys()->where('start_time','<',Carbon::now($companyTimeZone))->where('end_time','>',Carbon::now($companyTimeZone))->select('id')->get();

         $completed_survey=DB::table('participants')->whereIn('survey_id',$open)->where('participants.user_id',Auth::id())->where('completed',1)->join('surveys','surveys.id','=','participants.survey_id')
            ->select('surveys.id','surveys.type_id','surveys.start_time','surveys.end_time','surveys.user_id','surveys.title','surveys.title','participants.completed')
            ->get();
        $closed=Company::find(Auth::User()->company_id)->hasSurveys()->where('start_time','<',Carbon::now($companyTimeZone))->where('end_time','<',Carbon::now($companyTimeZone))->select('id')->get();
		$closed_survey=DB::table('participants')->whereIn('survey_id',$closed)->where('participants.user_id',Auth::id())->join('surveys','surveys.id','=','participants.survey_id')
            ->select('surveys.id','surveys.type_id','surveys.start_time','surveys.end_time','surveys.user_id','surveys.title','surveys.title','participants.completed')
            ->get();

        return  view('survey.complete')->with('completed',$completed_survey)->with('closed',$closed_survey);
    }
	
	
	public function switchLanguage(Request $request){
		return response()->json(array('stri'=>'success'));
	}
	
    public function show($id){
	  $userParticipatedInSurvey = DB::table('participants')
										->where('survey_id',$id)
										->where('user_id',Auth::User()->id)
										->value('user_id');
		if($userParticipatedInSurvey!==Auth::User()->id){
			Session::flash('message','We could not find you as a participant in this survey');
			return redirect()->back();
		}
      $email = Auth::user()->email;
      $userId = DB::table('users')->where('email',$email)->value('id');
      $surveyCategoryId = DB::table('surveys')->where('id',$id)->value('category_id');
      $surveyGroupId = DB::table('surveys')->where('id',$id)->value('user_group_id');//Done this way coz the original logic was different since surveys did not belong to groups
        if($this->ValidateSurvey($id)=='true'){
            if($this->SurveyStatus($id)=='open'){
               if(Auth::User()->participate_survey()->where('survey_id',$id)->first()->completed==1){
				   
			   }else{
                    if($this->SurveyType($id)=='self'){
						
					}else{
						//This is peer survey
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
										
								//This returns the external evaluators for this survey that the current logged in user has invited to evaluate him or her
								$participantsInvitedAsExternalEvaluators = DB::select(DB::raw(
									"select external_evaluators.id, external_evaluators.email, external_evaluators.confirmed
											from external_evaluators where external_evaluators.survey_id = :surveyId 
												and external_evaluators.invited_by_user_id = :invitedByUserId"),
										array("surveyId"=>$id,"invitedByUserId"=>Auth::User()->id));
										
										
								//This returns the external evaluators (those that have confirmed) for this survey that the current logged in user has invited to evaluate him or her
								$participantsConfirmedAsExternalEvaluators = DB::select(DB::raw(
									"select external_evaluators.id, external_evaluators.email, external_evaluators.confirmed
											from external_evaluators where external_evaluators.survey_id = :surveyId 
												and external_evaluators.invited_by_user_id = :invitedByUserId
												and external_evaluators.confirmed = 1"),
										array("surveyId"=>$id,"invitedByUserId"=>Auth::User()->id));
										
										
								//This returns the external evaluators (those that have not confirmed) for this survey that the current logged in user has invited to evaluate him or her
								$participantsNotConfirmedAsExternalEvaluators = DB::select(DB::raw(
									"select external_evaluators.id, external_evaluators.email, external_evaluators.confirmed
											from external_evaluators where external_evaluators.survey_id = :surveyId 
												and external_evaluators.invited_by_user_id = :invitedByUserId
												and external_evaluators.confirmed = 0"),
										array("surveyId"=>$id,"invitedByUserId"=>Auth::User()->id));
								
								
								
								//The computer is a procedural flow machine such that if we manage to get here, then the logged in user needs to select
								//evaluators or view ones that have completed
								$profileStatus = DB::table('user_profiles')->where('user_id',Auth::user()->id)->value('complete');
								if($profileStatus==0){
									return view('profile.edituser')->with('profile',Auth::User()->profile)->with('user',Auth::User());
								}
								if($profileStatus==1){
									return view('survey.peerSelectEvaluatorsExternal')
										->with('participants', $participant)
										->with('participantsNotSelectedAsEvaluators', $participantsNotSelectedAsEvaluators)
										->with('participantsInvitedAsExternalEvaluators', $participantsInvitedAsExternalEvaluators)
										->with('participantsConfirmedAsExternalEvaluators', $participantsConfirmedAsExternalEvaluators)
										->with('participantsNotConfirmedAsExternalEvaluators', $participantsNotConfirmedAsExternalEvaluators)
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
			
            }elseif($this->SurveyStatus($id)=='closed'){
				
            }elseif($this->SurveyStatus($id)=='pending'){
               
			}

        }else{
            return view('errors.404')->with('title',' Survey not found.')
                ->with('message','The survey you requested does not belong to your company or does not exist in Fincoda Survey System.');
        }
    }

	public function inviteEvaluators(Request $request){
			
    }
	
	
	public function inviteExternalEvaluators(Request $request){
			
    }
	
	
	public function registerExternalEvaluators(Request $request){
			
    }
	
	public function evaluateUserExternal($surveyId, $userId){
		
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
		return Redirect::to('external/survey/'.$surveyId)->with('success','Your have no users to evaluate');
	}
	
	
	public function viewPeerResults($surveyId, $userId){ 
	
	}
	

    public function ValidateSurvey($id){
        if(Company::find(Auth::User()->company_id)->hasSurveys()->where('id',$id)->exists()){
            return true;

        }else{
            return false;
        }
    }

    public function SurveyStatus($id){
        if(Survey::find($id)->start_time<Carbon::now()->addHour(1) && Survey::find($id)->end_time>Carbon::now()->addHour(1)) {
            return 'open';
        }elseif(Survey::find($id)->start_time<Carbon::now()->addHour(1) && Survey::find($id)->end_time<Carbon::now()->addHour(1)){
            return 'closed';
        }else{
            return 'pending';
        }

    }

    public function SurveyType($id){
        if(Survey_Type::find(Survey::find($id)->type_id)->name=='peer survey'){
            return 'peer';
        }else{
            return 'self';
        }
    }

    public function store(Request $request){
		count($request->radio);
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
            return Redirect::to('external/survey/'.$request->survey_id)->with('success','Your answer has been saved. Thank you for answering the survey. The complete result can be viewed once the survey is completed. Also please take a moment to check your profile and ensure that its up to date ');
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
						    'updated_at'=>Carbon::now()
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
									'updated_at'=>Carbon::now()
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
									'updated_at'=>Carbon::now()
						]);
				}
				DB::commit();
				return Redirect::to('external/survey/'.$request->survey_id)->with('success','Your answer has been saved. Thank you for answering the survey. The complete result can be viewed once the survey is completed. Also please take a moment to check your profile and ensure that its up to date ');
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
