<?php

namespace App\Http\Controllers\special;

use App\Http\Controllers\EmailTrait;
use App\Indicator;
use App\Survey;
use App\User;
use App\User_Group;
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


class GroupSurveyController extends Controller
{
    use EmailTrait;
    public function index(){
        //group dashboard
    $open=Auth::User()->creates_survey()
        ->where('start_time','<',Carbon::now()->addHour(1))
        ->where('end_time','>',Carbon::now()->addHour(1))
        ->where('category_id',2)->get();
    $pending=Auth::User()->creates_survey()->
    where('start_time','>',Carbon::now()->addHour(1))
        ->where('end_time','>',Carbon::now()->addHour(1))
        ->where('category_id',2)->get();
    $closed=Auth::User()->creates_survey()
        ->where('start_time','<',Carbon::now()->addHour(1))
        ->where('end_time','<',Carbon::now()->addHour(1))
        ->where('category_id',2)->get();
        return view('dashboard')->with('open',$open)->with('closed',$closed)->with('pending',$pending);

    }

    public function create()
    {

        return view('survey.create')->with('indicators',Indicator::all())
            ->with('participants',DB::table('users')
                ->join('role_user','role_user.user_id','=','users.id')
                ->where('role_id','=',3)
                ->join('user_in_groups','user_in_groups.user_id','=','users.id')
                ->join('user_groups','user_groups.id','=','user_in_groups.user_group_id')
                ->join('companies','companies.id','=','users.company_id')
                ->where('companies.id','=',Auth::User()->company_id)
                ->where('user_groups.administrator','=',Auth::id())
                ->get());

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


                    //send email to the participants
                    foreach($participants as $participant){
                        $member_email[]=User::find($participant->user_id)->email;
                    }

                    $this->email('email.newsurvey',['owner'=>$owner->name, 'title'=>$survey->title],$member_email);



                    return Redirect::to('special')->with('success','The survey has been created successfully.
                 The survey will be open to the participants on the open date you have specified. Also, you can view the complete result of the survey once it is closed ');

                }
            }




        }
    public function show($id){

        if($this->ValidateSurvey($id)){
            if($this->SurveyStatus($id)=='pending'){
                return view('survey.update')->with('survey',Survey::find($id))
                    ->with('indicators',Indicator::all())
                    ->with('participants',Survey::find($id)->participants);
            }else{//Its assumed that in this function only group surveys will be handled or given as parameters
              //Its also assumed that only Surveys belonging to the concerned special user will be given as parameters
              //The function should return the results of the survey in the group
                    $surveyScoreAllUsers = DB::table('indicators')
                            ->join('results','results.indicator_id','=','indicators.id')
                            ->join('user_in_groups','results.user_id','=','user_in_groups.user_id')
                            ->join('indicator_groups','indicators.group_id','=','indicator_groups.id')
                            ->select('user_in_groups.user_group_id as Group_ID','results.survey_id as Survey_ID',
                                     'results.user_id as User_ID','indicators.id as Indicator_ID',
                                     'indicators.indicator as Indicator', 'results.answer as Answer',
                                     'indicators.group_id as Indicator_Group_ID','indicator_groups.name as Indicator_Group')
                            ->where('results.survey_id',$id)
                            ->groupBy('user_in_groups.user_group_id', 'results.user_id', 'results.survey_id', 'indicators.id')
                            ->get();

                                      //This returns the paginated results for survey score all users
                                      $page = LengthAwarePaginator::resolveCurrentPage();
                                      $collection = new Collection($surveyScoreAllUsers);
                                      $itemsPerPage = 5;
                                      $slicedCollection = $collection->slice(($page-1)*$itemsPerPage,$page)->all();
                                      $paginatedCollection = new LengthAwarePaginator($slicedCollection,count($collection),$itemsPerPage);

                    //This returns the average of the user group per indicator in this survey
                    $surveyGroupAveragePerIndicatorAllUsers = DB::select(DB::raw(
                            "SELECT user_in_groups.user_group_id as Group_ID, results.survey_id as Survey_ID,
                            indicators.id as Indicator_ID, indicators.indicator as Indicator,
                            AVG(results.answer) as Group_Average
                            FROM indicators
                            join results on results.indicator_id = indicators.id
                            join user_in_groups on results.user_id = user_in_groups.user_id
                            WHERE results.survey_id = :surveyId
                            GROUP BY user_in_groups.user_group_id, results.survey_id, indicators.id"),
                            array("surveyId"=>$id));

                    //This returns the average of each user per indicator group for this survey
                    $surveyScoreGroupAvgPerIndicatorGroup = DB::select(DB::raw(
                            "SELECT user_in_groups.user_group_id as Group_ID, results.survey_id as Survey_ID,
                            results.user_id as User_ID, indicators.group_id as Indicator_Group_ID,
                            indicator_groups.name as Indicator_Group,
                            AVG(results.answer) as Indicator_Group_Average
                            FROM indicators
                            JOIN results on results.indicator_id = indicators.id
                            JOIN indicator_groups on indicators.group_id = indicator_groups.id
                            JOIN user_in_groups on results.user_id = user_in_groups.user_id
                            WHERE results.survey_id = :surveyId
                            GROUP BY user_in_groups.user_group_id, results.survey_id, results.user_id, indicators.group_id"),
                            array("surveyId"=>$id));

                    //This returns the average of each user group per indicator group in this survey
                    $surveyScorePerIndicatorGroup = DB::select(DB::raw(
                            "SELECT user_in_groups.user_group_id as Group_ID, results.survey_id as Survey_ID,
                            indicators.group_id as Indicator_Group_ID,
                            indicator_groups.name as Indicator_Group,
                            AVG(results.answer) as Indicator_Group_Average
                            FROM indicators
                            JOIN results on results.indicator_id = indicators.id
                            JOIN indicator_groups on indicators.group_id = indicator_groups.id
                            JOIN user_in_groups on results.user_id = user_in_groups.user_id
                            WHERE results.survey_id = :surveyId
                            GROUP BY results.survey_id, indicators.group_id"),
                            array("surveyId"=>$id));

                    return view('survey.resultForSpecial')->with('survey',Survey::find($id))
                    ->with(['surveyScoreAllUsers' => $surveyScoreAllUsers])
                    ->with(['surveyGroupAveragePerIndicatorAllUsers' => $surveyGroupAveragePerIndicatorAllUsers])
                    ->with(['surveyScorePerIndicatorGroup' => $surveyScorePerIndicatorGroup])
                    ->with(['surveyScoreGroupAvgPerIndicatorGroup' => $surveyScoreGroupAvgPerIndicatorGroup])
                    ->with('participants',Survey::find($id)->participants)
                    ->with('answers',count(Survey::find($id)->participants()->where('completed',1)->get()));
            }

        }else{
            return view('errors.404')->with('title',' Survey Not found')
                ->with('message','The survey you requested doe not belong to your company/does not exists in the Fincoda Survey System or you do not have permission to access it.');
        }


    }
    public function update(Request $request,$id){
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

                return Redirect::to('special/survey')->with('success','The survey has been updated successfully.
                 The survey will be open to the participants on the open date you have specified. Also, you can view the complete result of the survey once it is closed. ');


            }


        }
    }


    public function ValidateSurvey($id){

        if(Auth::User()->creates_survey()->where('id',$id)->exists()){
        return true;
        }else{
            return false;
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
