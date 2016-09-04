<?php

namespace App\Http\Controllers\special;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $open_survey=Auth::User()->company->hasSurveys()->where('start_time','<',Carbon::now()->addHour(1))->where('end_time','>',Carbon::now()->addHour(1))->select('id')->get();
        $open=Auth::User()->participate_survey()->whereIn('survey_id',$open_survey)->select('survey_id')->get();

        $closed_survey=Auth::User()->company->hasSurveys()->where('start_time','<',Carbon::now()->addHour(1))->where('end_time','<',Carbon::now()->addHour(1))->select('id')->get();
        $closed=Auth::User()->participate_survey()->whereIn('survey_id',$closed_survey)->select('survey_id')->get();


        return view('dashboard')->with('open',DB::table('surveys')->whereIn('surveys.id',$open)
            ->join('participants','participants.survey_id','=','surveys.id')
            ->where('participants.user_id','=',Auth::id())
            ->select('surveys.id','surveys.start_time','surveys.end_time','surveys.title','surveys.type_id','surveys.user_id','participants.completed')
            ->get())
            ->with('closed',DB::table('surveys')->whereIn('id',$closed)->get());
    }
}
