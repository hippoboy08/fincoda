<?php

namespace App\Http\Controllers\special;

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
use App\Participant;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CompanySurveyController extends Controller
{
    public function index()
    {

        $open = Auth::User()->company->hasSurveys()->where('start_time', '<', Carbon::now()->addHour(1))->where('end_time', '>', Carbon::now()->addHour(1))->select('id')->get();

        $completed_survey = DB::table('participants')->whereIn('survey_id', $open)->where('participants.user_id', Auth::id())->where('completed', 1)->join('surveys', 'surveys.id', '=', 'participants.survey_id')
            ->select('surveys.id', 'surveys.type_id', 'surveys.start_time', 'surveys.end_time', 'surveys.user_id', 'surveys.title', 'surveys.title', 'participants.completed')
            ->get();
        $closed = Auth::User()->company->hasSurveys()->where('start_time', '<', Carbon::now()->addHour(1))->where('end_time', '<', Carbon::now()->addHour(1))->select('id')->get();
        $closed_survey = DB::table('participants')->whereIn('survey_id', $closed)->where('participants.user_id', Auth::id())->join('surveys', 'surveys.id', '=', 'participants.survey_id')
            ->select('surveys.id', 'surveys.type_id', 'surveys.start_time', 'surveys.end_time', 'surveys.user_id', 'surveys.title', 'surveys.title', 'participants.completed')
            ->get();

        return view('survey.complete')->with('completed', $completed_survey)->with('closed', $closed_survey);
    }

    public function show($id)
    {

      $email = Auth::user()->email;
      $userId = DB::table('users')->where('email',$email)->value('id');
      if ($this->ValidateSurvey($id) == 'true') {
            if ($this->SurveyStatus($id) == 'open') {

                if (Auth::User()->participate_survey()->where('survey_id', $id)->first()->completed == 1) {
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
                        return 'peer evaluation not yet implemented';
                    }

                } else {
                    if ($this->SurveyType($id) == 'self') {
                        return view('survey.answer')->with('indicators', Indicator::all())
                            ->with('survey', Survey::find($id));
                    } else {
                        return 'this is peer evaluation';
                    }

                }

            } elseif ($this->SurveyStatus($id) == 'closed') {
                if (Auth::User()->participate_survey()->where('survey_id', $id)->first()->completed == 1) {
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
                                              AND results.user_id = $userId
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
                        return 'this is the page of peer evaluation result';
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

    public function ValidateSurvey($id)
    {
        if (Company::find(Auth::User()->company_id)->hasSurveys()->where('id', $id)->exists()) {
            return true;
        } else {
            return false;
        }
    }

    public function SurveyStatus($id)
    {
        if (Survey::find($id)->start_time < Carbon::now()->addHour(1) && Survey::find($id)->end_time > Carbon::now()->addHour(1)) {
            return 'open';
        } elseif (Survey::find($id)->start_time < Carbon::now()->addHour(1) && Survey::find($id)->end_time < Carbon::now()->addHour(1)) {
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

        if(count($request->radio)==count(Indicator::all())){

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

            return Redirect::to('special/survey')->with('success','Your answer has been saved. Thank you for answering the survey. The complete result can be viewed once the survey is completed ');



        }else{
            return redirect()->back()->with('fail',' Could not save your answer. All the indicators have to be marked. Please check the unmarked indicator(s) and submit the survey again.')
                ->withInput();
        }

    }
}
