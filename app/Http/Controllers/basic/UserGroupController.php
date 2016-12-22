<?php

namespace App\Http\Controllers\basic;

use App\Survey;
use App\User_Group;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $groups=Auth::User()->associated_groups;
        for($i=0; $i<count($groups); $i++){
            $group_id[]=$groups[$i]->user_group_id;
        }
        if(empty($group_id)){
			return redirect()->back()
                    ->with('title', ' Group not found')->with('message','You have not been associated with any company group.');
        }else{
            return view('usergroup.index')->with('groups',User_Group::whereIn('id',$group_id)->get());
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        if($this->ValidateGroup($id)){
          return view('usergroup.showBasic')->with('group',User_Group::find($id))
              ->with('members',User_Group::find($id)->hasMembers);
      }else  {
            return view('errors.404')->with('title',' User group not found ')
                ->with('message','The group you requested does not belong to your company or you do not belong to the group.');
      }
         //   $this->validateUser($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ValidateGroup($id){
        if(Auth::User()->company->hasUserGroups()->where('id',$id)->exists() && Auth::User()->associated_groups()->where('user_group_id',$id)->exists()){
        return true;
        }else{
            return false;
        }
    }
}
