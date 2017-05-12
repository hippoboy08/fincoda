<?php

namespace App\Http\Controllers\register;

use App\Company;
use App\Company_Profile;
use App\Http\Controllers\EmailTrait;
use App\User;
use App\Survey;
use App\Survey_Type;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    use EmailTrait;
    public function company()
    {
		$timeZones = timezone_identifiers_list();
        return view('register.company')->with('timeZones', $timeZones);
    }

    public function registercompany(Request $request)
    {
		$timeZones = timezone_identifiers_list();
		$validator = Validator::make($request->all(), [
            'company_name' => 'required|max:255',
            'company_type' => 'required|max:225',
            'country' => 'required',
			'time_zone' => 'required',
            'city' => 'required|max:255',
            'street' => 'required|max:255',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|max:20|confirmed',
            //'g-recaptcha-response' => 'required|recaptcha',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{


            $company_name=explode(' ',$request->company_name);

            //check if the company code generated is unique.
            do{
                $company_code=strtoupper($company_name[0]).'_'.str_random(12);
            }
            while(Company::where('company_code',$company_code)->exists());

            $slug=str_slug($request->company_name,'_');

			DB::beginTransaction();
			try{
            //store company
           $company=Company::create([
               'name'=>$request->company_name,
               'company_code'=>$company_code,
               'slug'=>$slug
           ]);
           $company_id=$company->id;
            //company profile
            Company::find($company->id)->profile()->save(new Company_Profile([
                'type'=>$request->company_type,
                'country'=>$request->country,
                'city'=>$request->city,
                'street'=>$request->street,
                'phone'=>$request->phone,
                'postcode'=>$request->postcode,
				'time_zone'=>$timeZones[$request->time_zone]

            ]));
            //create admin
            $admin=User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'company_id'=>$company_id,
                'password'=>bcrypt($request->password)
            ]);
            User::find($admin->id)->attachRole(1);

            //initiate admin profile
           User::find($admin->id)->profile()->create([

            ]);

            //send an email with the company code
            $name=$request->company_name;
            $code=$company_code;
            $this->email('email.registration',['name'=>$name,'link'=>url('/').'/login','code'=>$code],$admin->email);
			DB::commit();
			
			}catch(\Exception $e){
				DB::rollback();
				return $e;
				//return "An error occured; your request could not be completed ".$e->getMessage();
			}
          }

       return view('register.success')->with('success','Your Organisation has bee registered successfully. An Email has been sent to you containing your
       organisation code. Please do distribute it to you users. This code is required for member registration. Once members are registered,
       you can start creating surveys.');



    }

    public function user(){
        return view('register.user');
    }
    public function registeruser(Request $request){

      $validator=Validator::make($request->all(),[
            'company_code'=>'required|max:255',
            'name'=>'required|max:255',
            'email'=>'required|email|max:255|unique:users',
            'password'=>'required|confirmed|min:6|max:20'
            //'g-recaptcha-response' => 'required|recaptcha',
      ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
        if(Company::where('company_code',$request->company_code)->exists()){
            $company=Company::where('company_code',$request->company_code)->first();
            $company_id=$company->id;
            $user=User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'company_id'=>$company_id,
                'password'=>bcrypt($request->password)
            ]);
            //attach the basic user role
            $user->attachRole(3);
            //initiate the user profile
            $user->profile()->create([

            ]);

            return view('register.success')->with('success','You have been registered to the FINCODA Survey System successfully. Now you are able to receive the survey request created by
             your Administrators. Please login to explore more');
        }
        else{
            return redirect()->back()->with('fail','The Organisation Code you provided does not exist. Please contact your administrator for your Organisation Code.')
                ->withInput();
            }
        }
    }
	
	
	public function userExternalEvaluator(){
		return view('register.userExternal');
    }
	
    public function registeruserExternalEvaluator(Request $request){
		$validator=Validator::make($request->all(),[
			'emailOfWhoInvitedYou'=>'required|max:255',
            'surveyId'=>'required|max:255',
            'name'=>'required|max:255',
			'regEmail'=>'required|email|max:255',
            'yourEmail'=>'required|email|max:255',
            'password'=>'required|confirmed|min:6|max:20',
            //'g-recaptcha-response' => 'required|recaptcha',
		 ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput()->with('message','Validation failed');
        }
		$survey = DB::table('surveys')->where('id',$request->surveyId)->value('id');
		$surveyNumberEvaluators = DB::table('surveys')->where('id',$request->surveyId)->value('number_of_evaluators');
		$surveyCompany = DB::table('surveys')->where('id',$request->surveyId)->value('company_id');
		$inviterEmail = DB::table('users')->where('email',$request->emailOfWhoInvitedYou)->value('email');
		$inviterId = DB::table('users')->where('email',$request->emailOfWhoInvitedYou)->value('id');
		$inviterCompany = DB::table('users')->where('email',$request->emailOfWhoInvitedYou)->value('company_id');
		$yourEmail = DB::table('users')->where('email',$request->yourEmail)->value('email');
		$invitedAlreadyExists = DB::table('external_evaluators')//Invited already exists in the company
										->where('invited_by_user_id',$inviterId)
										->where('survey_id',$survey)
										->where('email',$request->yourEmail)->value('confirmed');
		$emailThatReceivedInviteExists = DB::table('external_evaluators')//Invited already exists in the company
										->where('invited_by_user_id',$inviterId)
										->where('survey_id',$survey)
										->where('email',$request->regEmail)->value('email');
		$emailYourRegisteringExists = DB::table('users')->where('email',$request->yourEmail)->value('email');
		
		
		$modifiedEmail = $inviterCompany.'.'.$request->yourEmail;
		$modifiedEmailExists = DB::table('users')->where('email',$modifiedEmail)->value('email');
		
		if(!empty($modifiedEmailExists)){
			return redirect()->back()->withInput()->with('message','The email you are registering already exists');
		}
		//dd($modifiedEmail);			
								
		if(empty($survey)){
            return redirect()->back()->withInput()->with('message','We could not find the record for that survey');
        }
		
		$modifiedEmail = $survey.$request->yourEmail;
		$modifiedEmailExists = DB::table('users')->where('email',$modifiedEmail)->value('email');
		if(!empty($modifiedEmailExists)){
			return redirect()->back()->withInput()->with('message','The email you are registering already exists');
		}
		
		if(!empty($emailYourRegisteringExistsAndExternal)){
			return redirect()->back()->withInput()->with('message','The email you are registering already exists');
		}
		
		if(empty($emailThatReceivedInviteExists)){
            return redirect()->back()->withInput()->with('message','We could not find the email you received our invitation on');
        }
		if(empty($inviterId)){
            return redirect()->back()->withInput()->with('message','We could not find the record of the person who invited you');
        }
		
		//This returns the evaluators for this survey that the current logged in user selected
		$evaluators = DB::select(DB::raw(
			"select users.id, users.name, users.email from users where users.id in 
				(select peer_surveys.peer_id from peer_surveys 
					where peer_surveys.survey_id = :surveyId and peer_surveys.user_id = :currentUser)"),
				array("surveyId"=>$request->survey_id,"currentUser"=>$inviterId));
		
		$requiredNumEvaluators = $surveyNumberEvaluators-count($evaluators);
		
		if($requiredNumEvaluators==count($evaluators)){
			return redirect()->back()->withInput()->with('message','Unfortunately the required number of '.$surveyNumberEvaluators.' users to do the evaluation has already been reached');
        }
		
		if($surveyCompany != $inviterCompany){
            return redirect()->back()->withInput()->with('message','Its likely you belong to a different company and the survey belongs to another company');
        }
		if($invitedAlreadyExists==1){
            return redirect()->back()->withInput()->with('message','System shows that you have already been registered for that user for that survey');
        }
		//DB::beginTransaction();
		try{
		if(!empty($emailYourRegisteringExists)){//This means email already exists
			$emailYourRegisteringExistsAndExternal = DB::table('users')->where('email',$request->yourEmail)
														->where('external',1)->value('email');
			$emailYourRegisteringExistsAndExternalAndModified = DB::table('users')->where('email',$request->yourEmail)
																			  ->where('external',1)
																			  ->where('external_modified_email',1)
																			  ->value('email');
			if(!empty($emailYourRegisteringExistsAndExternal)){
				return redirect()->back()->withInput()->with('message','System shows that you have already been registered on the system; simply login with that email and proceed to do what you want to do');
			}
			if(!empty($emailYourRegisteringExistsAndExternalAndModified)){
				return redirect()->back()->withInput()->with('message','System shows that you have already been registered on the system; simply login with that email and proceed to do what you want to do');
			}
		    $user = DB::table('users')
						->insertGetId([
							'name'=>$request->name,
							'external'=>1,
							'external_modified_email'=>1,
							'email'=>$inviterCompany.'.'.$request->yourEmail,
							'company_id'=>$inviterCompany,
							'created_at'=>Carbon::now(),
							'updated_at'=>Carbon::now(),
							'password'=>bcrypt($request->password)
						]);
						
			DB::table('role_user')
						->insert([
							'user_id'=>$user,
							'role_id'=>4
						]);
						
			DB::table('user_profiles')
						->insert([
							'user_id'=>$user
						]);
						
			DB::table('external_evaluators')
								->where('invited_by_user_id',$inviterId)
								->where('survey_id',$survey)
								->where('email',$request->regEmail)
								->update([
									'confirmed'=>1,
									'registered_email'=>$inviterCompany.'.'.$request->yourEmail,
									'updated_at'=>Carbon::now()
						]);
						
			DB::table('participants')
						->insert([
							'survey_id'=>$survey,
							'user_id'=>$user,
							'updated_at'=>Carbon::now()
						]);
			
			DB::table('peer_surveys')
						->insert([
							'survey_id'=>$request->surveyId,
							'peer_id'=>$user,
							'user_id'=>$inviterId,
							'created_at'=>Carbon::now(),
							'updated_at'=>Carbon::now()
						]);
						
			//send email to the registered user
			$this->email('email.registrationExternalUser',['invitedEmail'=>$request->name,  'link'=>url('/').'/login',
            	     'yourLoginId'=>$inviterCompany.'.'.$request->yourEmail],$request->yourEmail);
               
            return view('register.success')->with('success','You have been registered to the FINCODA Survey System successfully and an email has been sent to you.
             Your login id is: '.$inviterCompany.'.'.$request->yourEmail);
        }else
		if(empty($emailYourRegisteringExists)){//This means email does not exist; we can go ahead and put it on the system
		   $user = DB::table('users')
						->insertGetId([
							'name'=>$request->name,
							'external'=>1,
							'email'=>$request->yourEmail,
							'company_id'=>$inviterCompany,
							'created_at'=>Carbon::now(),
							'updated_at'=>Carbon::now(),
							'password'=>bcrypt($request->password)
						]);
						
			DB::table('role_user')
						->insert([
							'user_id'=>$user,
							'role_id'=>4
						]);
						
			DB::table('user_profiles')
						->insert([
							'user_id'=>$user
						]);
						
			DB::table('peer_surveys')
						->insert([
							'survey_id'=>$request->surveyId,
							'peer_id'=>$user,
							'user_id'=>$inviterId,
							'created_at'=>Carbon::now(),
							'updated_at'=>Carbon::now()
						]);
						
			DB::table('external_evaluators')
								->where('invited_by_user_id',$inviterId)
								->where('survey_id',$survey)
								->where('email',$request->regEmail)
								->update([
									'confirmed'=>1,
									'registered_email'=>$request->yourEmail,
									'updated_at'=>Carbon::now()
						]);
						
			DB::table('participants')
						->insert([
							'survey_id'=>$survey,
							'user_id'=>$user,
							'updated_at'=>Carbon::now()
						]);
						
            return view('register.success')->with('success','You have been registered to the FINCODA Survey System successfully. Now you are able to receive the survey request created by
             your Administrators. Please login to explore more');
		//DB::commit();
        }
		else{
            return redirect()->back()->with('message','We could not register you on the system')
                ->withInput();
            }
		}catch(\Exception $e){
				DB::rollback();
				return "An error occured; your request could not be completed ".$e->getMessage();
			}
    }
}