<?php

namespace App\Http\Controllers\register;

use App\Company;
use App\Company_Profile;
use App\Http\Controllers\EmailTrait;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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
            'g-recaptcha-response' => 'required|recaptcha',

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
            $this->email('email.registration',['name'=>$name,'code'=>$code],$admin->email);
			DB::commit();
			
			}catch(\Exception $e){
				DB::rollback();
				return "An error occured; your request could not be completed ".$e->getMessage();
			}
          }

       return view('register.success')->with('success','Your Organisation has bee registered successfully. An Email has been sent to you containing your
       organisation code. Please do distribute it to you users. This code is required for member registration. Once members are registered,
       you can start creating surveys.');



    }

    public function user()
    {
        return view('register.user');
    }
    public function registeruser(Request $request){

      $validator=Validator::make($request->all(),[
            'company_code'=>'required|max:255',
            'name'=>'required|max:255',
            'email'=>'required|email|max:255|unique:users',
            'password'=>'required|confirmed|min:6|max:20',
            'g-recaptcha-response' => 'required|recaptcha',
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
}