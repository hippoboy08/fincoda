<?php

namespace App\Http\Controllers\special;

use App\Indicator;
use App\User_Group;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class GroupSurveyController extends Controller
{
    public function index(){

    }

    public function create()
    {

        return view('survey.create')->with('indicators',Indicator::all())
            ->with('participants',DB::table('users')->join('role_user','role_user.user_id','=','users.id')->where('role_id','=',3)->get());

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

                if($from<Carbon::now() || $to<Carbon::now()){
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


                 return Redirect::to('special')->with('success','Your survey has been created successfully.
                 The survey will be open to the participants on the open date you have specified. Also, you can view the complete result of the survey once it is closed ');

                }
            }




        }



}
