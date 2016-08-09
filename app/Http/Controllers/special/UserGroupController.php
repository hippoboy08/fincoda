<?php

namespace App\Http\Controllers\special;

use App\User;
use App\User_Group;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserGroupController extends Controller
{
 public function index(){

 $group=Auth::User()->group_administrator;
  if(!$group){
   return view('errors.404')->with('title',' Group not found')
       ->with('message','You have not been assigned any group. Please contact your company administrator.');
  }else{
   return view('usergroup.show')->with('group',$group)->with('members',User_Group::find($group->id)->hasMembers);

  }


 }

}
