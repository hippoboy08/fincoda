<?php

namespace App\Http\Controllers\admin;

use App\Company;
use App\Company_Profile;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class ProfileController extends Controller
{
    public function company(){
        $company=Auth::User()->company()->first();
        $company_profile=$company->profile()->first();
        return view('profile.company')->with('company',$company)
            ->with('company_profile',$company_profile);

}
    public function editcompany(){
        $company=Auth::User()->company()->first();
        $company_profile=$company->profile()->first();

        return view('profile.editcompany')->with('company',$company)->with('company_profile',$company_profile);

    }

    public function updatecompany(Request $request){
       $user_company=Auth::User()->company()->first();
       $company=Company::find($user_company->id);



        $validator=Validator::make($request->all(),[
            'company_name' => 'required|max:255',
            'company_type' => 'required|max:225',
            'country' => 'required',
            'city' => 'required|max:255',
            'address' => 'required|max:255',

        ]);


        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
            $company->name=$request->company_name;


            $profile=$company->profile()->first();
            $profile->type=$request->company_type;
            $profile->country=$request->country;
            $profile->city=$request->city;
            $profile->street=$request->address;
            $profile->email=$request->email;
            $profile->phone=$request->phone;
            $profile->postcode=$request->postcode;

            $profile->save();
            $company->save();

            return Redirect::to('admin/company')->with('success','Your company profile has been updated successfully.');




        }

    }

//Return the edit page for the company profile
public function editCompanyProfile(){

  $company=Auth::User()->company()->first();
  $company_profile=$company->profile()->first();
  return view('profile.companyEdit',compact('company','company_profile'));
}

//Carry out the actual update
public function updateCompanyProfile(){
    $input=Input::all();
      //  return $input["country"];
    $company=Auth::User()->company()->first();
    $company->name=$input["company_name"];
    $company->save();

  //  $company_profile=CompanyProfile::find();
    return "the company profiles updated";
}

//Delete Company Profile; this means a cascading delete that removes all surveys and members
//and everything pertaining to the company
public function deleteCompanyProfile(){

  $company=Auth::User()->company()->first();
  $company_profile=$company->profile()->first();
  return view('profile.companyEdit',compact('company','company_profile'));
}

}
