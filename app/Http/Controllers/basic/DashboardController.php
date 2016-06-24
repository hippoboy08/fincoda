<?php

namespace App\Http\Controllers\basic;

use App\Participant;
use App\Survey;
use Carbon\Carbon;
use App\Company;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){


      $survey_open=Company::find(Auth::User()->company_id)->hasSurveys()->where('start_time','<=',Carbon::now())->where('end_time','>',Carbon::now())->select('id')->get();
      $open=Auth::User()->participate_survey()->whereIn('survey_id',$survey_open)->select('survey_id')->get();


      $survey_closed=Company::find(Auth::User()->company_id)->hasSurveys()->where('start_time','<=',Carbon::now())->where('end_time','<',Carbon::now())->select('id')->get();
      $closed=Auth::User()->participate_survey()->whereIn('survey_id',$survey_closed)->select('survey_id')->get();


    return view('dashboard')->with('open',DB::table('surveys')->whereIn('surveys.id',$open)
                                    ->join('participants','participants.survey_id','=','surveys.id')
                                    ->where('participants.user_id','=',Auth::id())
                                    ->select('surveys.id','surveys.start_time','surveys.end_time','surveys.title','surveys.type_id','surveys.user_id','participants.completed')
                                    ->get())
            ->with('closed',DB::table('surveys')->whereIn('id',$closed)->get());

        }
}
