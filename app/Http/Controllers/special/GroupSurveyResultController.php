<?php

namespace App\Http\Controllers\special;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GroupSurveyResultController extends Controller
{
    public function index(){

        return view('survey.index')->with('closed',Auth::User()->creates_survey()->where('end_time','<',Carbon::now())->get());
    }
}
