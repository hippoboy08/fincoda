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

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;


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

    public function getParticipantDetails(Request $request){

          return view('survey.index')->with('closed',Company::find(Auth::User()->company_id)->hasSurveys()->where('end_time','<',Carbon::now()->addHour(1))->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
                                ->groupBy('results.survey_id', 'results.user_id', 'indicators.id')
                                ->get();

                                //This returns the paginated results for survey score all users
                                $page = LengthAwarePaginator::resolveCurrentPage();
                                $collection = new Collection($surveyScoreAllUsers);
                                $itemsPerPage = 5;
                                $slicedCollection = $collection->slice(($page-1)*$itemsPerPage,$page)->all();
                                $paginatedCollection = new LengthAwarePaginator($slicedCollection,count($collection),$itemsPerPage);              

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

              return view('survey.result')->with('survey',Survey::find($id))
              ->with(['surveyScoreAllUsers' => $surveyScoreAllUsers])
              ->with(['surveyGroupAveragePerIndicatorAllUsers' => $surveyGroupAveragePerIndicatorAllUsers])
              ->with(['surveyScorePerIndicatorGroup' => $surveyScorePerIndicatorGroup])
              ->with(['surveyScoreGroupAvgPerIndicatorGroup' => $surveyScoreGroupAvgPerIndicatorGroup])
              ->with('participants',Survey::find($id)->participants)
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
