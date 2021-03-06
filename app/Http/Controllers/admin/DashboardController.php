<?php

namespace App\Http\Controllers\admin;

use App\Company;
use App\Participant;
use App\Role_User;
use App\Survey;
use App\User;
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
    //get all the admins of the company
   User::where('company_id',Auth::User()->company_id)->get();

    $admins=DB::table('users')->where('company_id',Auth::User()->company_id)
        ->join('role_user','role_user.user_id','=','users.id')
        ->where('role_user.role_id','=',1)
        ->select('users.id')->get();

    foreach($admins as $admin){
        $admin_id[]=$admin->id;
    }

    $open=Company::find(Auth::User()->company_id)->hasSurveys()->whereIn('user_id',$admin_id)
        ->where('start_time','<=',Carbon::now($companyTimeZone))
        ->where('end_time','>',Carbon::now($companyTimeZone))->get();
    $closed=Company::find(Auth::User()->company_id)->hasSurveys()->whereIn('user_id',$admin_id)
        ->where('start_time','<',Carbon::now($companyTimeZone))
        ->where('end_time','<',Carbon::now()->addHour(1))->get();
    $pending=Company::find(Auth::User()->company_id)->hasSurveys()->whereIn('user_id',$admin_id)
        ->where('start_time','>',Carbon::now($companyTimeZone))
        ->where('end_time','>',Carbon::now($companyTimeZone))->get();

    return view('dashboard')->with('open',$open)->with('closed',$closed)->with('pending',$pending);
}

public function switchLanguage(Request $request){
		Session::put('language',$request['languageId']);
		Session::save();
	return response()->json(array('stri'=>$request['languageId']));
}

}
