<?php

namespace App\Http\Controllers\admin;

use App\Survey;
use App\User_Group;
use App\User_In_Group;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class UserGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('usergroup.index')->with('groups',Company::find(Auth::User()->company_id)->hasUserGroups()->orderBy('id','desc')->get());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $special_users=Company::find(Auth::User()->company_id)->hasUserGroups()->get();
        $id[]='';
        for($i=0; $i<count($special_users); $i++){
            $id[]=$special_users[$i]->administrator;
        }

        return view('usergroup.createAdmin')->with('administrators',
            DB::table('users')->where('company_id',Auth::User()->company_id)
                ->join('role_user','role_user.user_id','=','users.id')
                ->where('role_user.role_id','=',2)
                ->lists('users.name','users.id'))
            ->with('users',DB::table('users')->where('company_id',Auth::User()->company_id)
            ->join('role_user','role_user.user_id','=','users.id')
            ->where('role_user.role_id','=',3)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|max:255',
            'editor1'=>'required',
            'users'=>'required'
        ]);
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }else{
			//This query is costly coz this unique key constraint could have been put at the database level
           if(Company::find(Auth::User()->company_id)->hasUserGroups()->where(strtoupper('name'),strtoupper($request->name))->exists()){
               return redirect()->back()->with('fail','A group with same name already exists in your company. Please create a group with different name.')->withInput();
           }else{

               $group=User_Group::create([
                    'name'=>$request->name,
                    'description'=>$request->editor1,
                    'company_id'=>Auth::User()->company_id,
                    'created_by'=>Auth::id(),
                    'administrator'=>$request->administrator
                ]);

               foreach($request->users as $user){
                User_In_Group::create([
                    'user_id'=>$user,
                    'user_group_id'=>$group->id
                ]);
               }

               return Redirect::to('admin/usergroup')->with('success','A new user group has been created successfully.');

           }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      if($this->validateUserGroup($id)=='true'){


          return view('usergroup.showAdmin')->with('group',User_Group::find($id))
              ->with('members',User_Group::find($id)->hasMembers);

      }else{
          return view('errors.404')->with('title',' User group not found. ')
              ->with('message','The group you requested does not belong to your company.');
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editUserGroup($id)
    {
	 if($this->validateUserGroup($id)=='true'){
		//This was checking for the administrators of the group so that in case one had already been assigned a group
		//then there would not be any need to return them to administer another group, but this design approach was dropped
		//and a user can now administer multiple groups
		$special_users=Company::find(Auth::User()->company_id)->hasUserGroups()->get();
        $groupAdmins[]='';
        for($i=0; $i<count($special_users); $i++){
            $groupAdmins[]=$special_users[$i]->administrator;
        }
		
		$group = User_Group::find($id);
		
		$administratorUser = DB::table('users')->where('id',$group->administrator)->first();
		
		
        $administrators = DB::table('users')
							->join('role_user','role_user.user_id','=','users.id')
							->where('company_id',Auth::User()->company_id)
							->where('role_user.role_id','=',2)
							->orderByRaw("CASE WHEN users.name='$administratorUser->name' THEN -1 ELSE users.name END")
							->lists('users.name','users.id');
							
		//This returns the group members
		$members = DB::select(DB::raw(
                            "select users.id as user_id, users.name, users.email from users 
							where users.id in (select user_in_groups.user_id from user_in_groups 
								where user_in_groups.user_group_id = :groupId)"),
                            array("groupId"=>$id));

							
		//This returns all users that are not in this group
		$users = DB::select(DB::raw(
                            "select users.id as user_id, users.name, users.email from users 
							where users.id not in (select user_in_groups.user_id from user_in_groups 
								where user_in_groups.user_group_id = :groupId)"),
                            array("groupId"=>$id));
		
        return view('usergroup.editAdmin')
						->with('administrators',$administrators)
						->with('group',$group)
						->with('users',$users)
						->with('members',$members);

      }else{
          return view('errors.404')->with('title',' User group not found. ')
              ->with('message','The group you requested does not belong to your company.');
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateUserGroup(Request $request)
    {
		$validation=Validator::make($request->all(),[
            'name'=>'required|max:255',
            'editor1'=>'required',
        ]);
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }else{
           if(Company::find(Auth::User()->company_id)->hasUserGroups()->where(strtoupper('name'),strtoupper($request->name))->exists()){
			   DB::table('user_groups')
						->where('id',$request->id)
						->update([
							'name'=>$request->name,
							'description'=>$request->editor1,
							'company_id'=>Auth::User()->company_id,
							'created_by'=>Auth::id(),
							'administrator'=>$request->administrator
                ]);


			if(!empty($request->usersToRemove)){
               foreach($request->usersToRemove as $user){
					DB::table('user_in_groups')
						->where('user_id', $user)
						->where('user_group_id', $request->id)
						->delete();
				}
			}
				
			if(!empty($request->usersToAdd)){
				foreach($request->usersToAdd as $user){
					DB::table('user_in_groups')
						->insert([
							'user_id'=>$user,
							'user_group_id'=>$request->id
						]);
				}
			}
				
               return Redirect::to('admin/usergroup')->with('success','A new user group has been edited successfully.');
           }else{
               return redirect()->back()->with('fail','A group with that name does not exist in your company. Please try a group with different name.')->withInput();   
           }
        }
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

    public function validateUserGroup($id){
       if(Company::find(Auth::User()->company_id)->hasUserGroups()->where('id',$id)->exists()){
           return true;
       }else{
           return false;

       }
    }
}
