<?php

namespace App\Http\Controllers\external;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class ProfileController extends Controller
{
    public function index(){

        $role=DB::table('role_user')->where('user_id',Auth::id())
            ->join('roles','roles.id','=','role_user.role_id')
            ->select('roles.display_name')->first();

        return view('profile.user')->with('user',Auth::User())
            ->with('profile',Auth::User()->profile)
            ->with('role',$role);
    }

    public function edit($id){
        return view('profile.edituser')->with('profile',Auth::User()->profile)->with('user',Auth::User());
    }
    public function update(Request $request, $id){
		$companyTimeZone = DB::table('company_profiles')->where('id',Auth::User()->company_id)->value('time_zone');
        if(Auth::id()==$id){
            $validation1=Validator::make($request->all(),[
               'name'=>'required|max:255',
			   'gender'=>'required|max:50',
			   'country'=>'required|max:50',
			   'city'=>'required|max:50',
			   'street'=>'required|max:255',
			   'phone'=>'required|max:255',
			   'highest_education'=>'required|max:255',
			   'professional_status'=>'required|max:255',
			   'dob'=>'required|max:255'
		   ]);
		   
		   if($request->professional_status=='Student'){
			   $validation2=Validator::make($request->all(),[
				   'study_level'=>'required|max:255',
				   'study_type'=>'required|max:50',
				   'post_graduate_aspirations'=>'required|max:50',
				   'study_stage'=>'required|max:50'
				]);
				
				if($validation2->fails()){
					return redirect()->back()->withErrors($validation2)->withInput();
				}
		   }
		   
		   if($request->professional_status=='Professional'){
			   $validation3=Validator::make($request->all(),[
				   'company_industry'=>'required|max:255',
				   'company_age'=>'required|max:50',
				   'study_type_you_did'=>'required|max:50',
				   'job_role'=>'required|max:50',
				   'company_size'=>'required|max:50'
				]);
				
				if($validation3->fails()){
					return redirect()->back()->withErrors($validation3)->withInput();
				}
		   }
		   
		   if(!empty($request->dob)){
				if($request->dob > Carbon::now($companyTimeZone) || $request->dob == Carbon::now($companyTimeZone)){
					return redirect()->back()
                    ->with('fail','Your date of birth cannot be after or equal to the current date and time. Your company timezone was set to: '.$companyTimeZone)
                    ->withInput();
				}
		   }
		   
           if($validation1->fails()){
               return redirect()->back()->withErrors($validation1)->withInput();
           }
		   
		   if($request->professional_status!=='Student'&&$request->professional_status!=='Professional'){
			   	return redirect()->back()
                    ->with('success','Check your professional status and try again: You are either a professional or a student ')
                    ->withInput();
		   }else{
				DB::beginTransaction();
				try{
					DB::table('users')
								->where('id',Auth::User()->id)
								->update([
									'name'=>$request->name
						]);
						
					DB::table('user_profiles')
								->where('user_id',Auth::User()->id)
								->update([
									'gender'=>$request->gender,
									'country'=>$request->country,
									'city'=>$request->city,
									'street'=>$request->street,
									'phone'=>$request->phone,
									'What_is_your_highest_completed_education'=>$request->highest_education,
									'Are_you_a_student_or_a_professional'=>$request->professional_status,
									'What_level_of_study_do_you_currently_follow'=>$request->study_level,
									'What_type_of_study_are_you_doing'=>$request->study_type,
									'What_kind_of_function_do_you_aspire_after_your_graduation'=>$request->post_graduate_aspirations,
									'At_what_stage_or_in_which_year_of_study_indicated_above_are_you'=>$request->study_stage,
									'What_industry_does_your_company_or_organization_belong_to'=>$request->company_industry,
									'How_long_has_your_company_or_organization_been_operating'=>$request->company_age,
									'What_type_of_study_did_you_do'=>$request->study_type_you_did,
									'What_is_your_job_role'=>$request->job_role,
									'How_big_is_the_company_or_organization_you_work_for'=>$request->company_size,
									'complete'=>1
						]);
					DB::commit();
					return redirect()->back()->with('success','Your profile has been updated successfully');
					}catch(\Exception $e){
					DB::rollback();
					return "An error occured; your request could not be completed ".$e->getMessage();
					}
            }


        }else{
            return 'Unauthentic user. The profile could not be updated';
        }
    }
}
