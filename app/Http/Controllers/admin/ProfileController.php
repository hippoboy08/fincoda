<?php

namespace App\Http\Controllers\admin;

use App\Company_Profile;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;



class ProfileController extends Controller
{
    public function company(){
        $company=Auth::User()->company()->first();
        $company_profile=$company->profile()->first();
        return view('profile.company')->with('company',$company)
            ->with('company_profile',$company_profile);

}
}
