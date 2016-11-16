<?php

namespace App\Http\Controllers\special;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;

class DashboardController extends Controller
{
    public function index(){
		
		$companyTimeZone = DB::table('company_profiles')->where('id',Auth::User()->company_id)->value('time_zone');
		$open = DB::table('surveys')
							->join('participants','participants.survey_id','=','surveys.id')
							->select('surveys.id','surveys.user_id','surveys.type_id','surveys.company_id','surveys.category_id',
							'participants.completed','surveys.title','surveys.description','surveys.end_message','surveys.start_time',
							'surveys.end_time','surveys.created_at','surveys.updated_at')
							->where('surveys.company_id',Auth::User()->company_id)
							->where('participants.user_id','=',Auth::User()->id)
							->where('surveys.start_time','<',Carbon::now($companyTimeZone))
							->where('surveys.end_time','>',Carbon::now($companyTimeZone))
							->where('surveys.category_id',1)->get();
		
							
		$closed = DB::table('surveys')
							->join('participants','participants.survey_id','=','surveys.id')
							->select('surveys.id','surveys.user_id','surveys.type_id','surveys.company_id','surveys.category_id',
							'participants.completed','surveys.title','surveys.description','surveys.end_message','surveys.start_time',
							'surveys.end_time','surveys.created_at','surveys.updated_at')
							->where('surveys.company_id',Auth::User()->company_id)
							->where('participants.user_id','=',Auth::User()->id)
							->where('surveys.start_time','<',Carbon::now($companyTimeZone))
							->where('surveys.end_time','<',Carbon::now($companyTimeZone))
							->where('surveys.category_id',1)->get();
		
        return view('dashboard')->with('open',$open)->with('closed',$closed);
		
		
    }
	
	public function switchLanguage(Request $request){
		Session::put('language',$request['languageId']);
		Session::save();
		\App::setLocale($request['languageId']);
	
	return response()->json(array('stri'=>$request['languageId']));
	}
}
