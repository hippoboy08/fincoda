<?php

namespace App\Http\Controllers\admin;

use App\Company_Profile;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;


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
