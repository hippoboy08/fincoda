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
    public function editCompany(){
        $company=Auth::User()->company()->first();
        $company_profile=$company->profile()->first();
		$timeZones = timezone_identifiers_list();
		$timeZonesCurrent = $company_profile->time_zone;
        $newTimeZonesArray = array();
		$newTimeZonesArray[] = $timeZonesCurrent;
		foreach($timeZones as $timeZone){
			if(strcmp($timeZone, $timeZonesCurrent)!==0){
				$newTimeZonesArray[] = $timeZone;
			}
		}
        return view('profile.editcompany')->with('company',$company)->with('company_profile',$company_profile)
											->with('timeZones', $newTimeZonesArray);

    }

    public function updateCompany(Request $request){
		$company=Auth::User()->company()->first();
        $company_profile=$company->profile()->first();
		$timeZones = timezone_identifiers_list();
		$timeZonesCurrent = $company_profile->time_zone;
        $newTimeZonesArray = array();
		$newTimeZonesArray[] = $timeZonesCurrent;
		foreach($timeZones as $timeZone){
			if(strcmp($timeZone, $timeZonesCurrent)!==0){
				$newTimeZonesArray[] = $timeZone;
			}
		}
		
       $user_company=Auth::User()->company()->first();
       $company=Company::find($user_company->id);

        $validator=Validator::make($request->all(),[
            'company_name' => 'required|max:255',
            'company_type' => 'required|max:225',
            'country' => 'required',
			'time_zone' => 'required',
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
			$profile->time_zone=$newTimeZonesArray[$request->time_zone];

            $profile->save();
            $company->save();

            return Redirect::to('admin/company')->with('success','Your company profile has been updated successfully.');




        }

    }

public function deleteCompanyProfile(){

  $company=Auth::User()->company()->first();
  $company_profile=$company->profile()->first();
  return view('profile.companyEdit',compact('company','company_profile'));
}

}
