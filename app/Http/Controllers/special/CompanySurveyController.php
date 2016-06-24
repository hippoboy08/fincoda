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

class CompanySurveyController extends Controller
{
    public function index()
    {

        $open = Auth::User()->company->hasSurveys()->where('start_time', '<', Carbon::now())->where('end_time', '>', Carbon::now())->select('id')->get();

        $completed_survey = DB::table('participants')->whereIn('survey_id', $open)->where('participants.user_id', Auth::id())->where('completed', 1)->join('surveys', 'surveys.id', '=', 'participants.survey_id')
            ->select('surveys.id', 'surveys.type_id', 'surveys.start_time', 'surveys.end_time', 'surveys.user_id', 'surveys.title', 'surveys.title', 'participants.completed')
            ->get();
        $closed = Auth::User()->company->hasSurveys()->where('start_time', '<', Carbon::now())->where('end_time', '<', Carbon::now())->select('id')->get();
        $closed_survey = DB::table('participants')->whereIn('survey_id', $closed)->where('participants.user_id', Auth::id())->join('surveys', 'surveys.id', '=', 'participants.survey_id')
            ->select('surveys.id', 'surveys.type_id', 'surveys.start_time', 'surveys.end_time', 'surveys.user_id', 'surveys.title', 'surveys.title', 'participants.completed')
            ->get();

        return view('survey.complete')->with('completed', $completed_survey)->with('closed', $closed_survey);
    }

    public function show($id)
    {

        if ($this->ValidateSurvey($id) == 'true') {
            if ($this->SurveyStatus($id) == 'open') {

                if (Auth::User()->participate_survey()->where('survey_id', $id)->first()->completed == 1) {
                    if ($this->SurveyType($id) == 'self') {
                        return view('survey.result')->with('survey', Survey::find($id))
                            ->with('participants', Survey::find($id)->participants)
                            ->with('answers', count(Survey::find($id)->participants()->where('completed', 1)->get()));
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
                    if ($this->SurveyType($id) == 'self') {
                        return view('survey.result')->with('survey', Survey::find($id))
                            ->with('participants', Survey::find($id)->participants)
                            ->with('answers', count(Survey::find($id)->participants()->where('completed', 1)->get()));
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
        if (Survey::find($id)->start_time < Carbon::now() && Survey::find($id)->end_time > Carbon::now()) {
            return 'open';
        } elseif (Survey::find($id)->start_time < Carbon::now() && Survey::find($id)->end_time < Carbon::now()) {
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

            return Redirect::to('special/survey')->with('success','Your answer has been saved thank you for answering the survey. The complete result can be viewed once the survey is completed ');



        }else{
            return redirect()->back()->with('fail',' Could not save your answer. All the indicators have to be marked. Please check the unmarked indicator(s) and submit the survey again.')
                ->withInput();
        }

    }
}