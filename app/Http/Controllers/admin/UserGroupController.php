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
			DB::beginTransaction();
			try{
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
			DB::commit();
               return Redirect::to('admin/usergroup')->with('success','A new user group has been created successfully.');
			}catch(\Exception $e){
				DB::rollback();
			}
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
								join role_user on role_user.user_id = users.id
								where users.id in (select user_in_groups.user_id from user_in_groups 
								where user_in_groups.user_group_id = :groupId) and role_user.role_id = 3 and users.company_id = :companyId"),
                            array("groupId"=>$id,"companyId"=>Auth::User()->company_id));

							
		//This returns all users that are not in this group
		$users = DB::select(DB::raw(
                            "select users.id as user_id, users.name, users.email from users
								join role_user on role_user.user_id = users.id
								where users.id not in (select user_in_groups.user_id from user_in_groups 
								where user_in_groups.user_group_id = :groupId) and role_user.role_id = 3 and users.company_id = :companyId"),
                            array("groupId"=>$id,"companyId"=>Auth::User()->company_id));
		
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
			//Checks to see if the user group exists
           if(Company::find(Auth::User()->company_id)->hasUserGroups()->where(strtoupper('name'),strtoupper($request->name))->exists()){
			DB::beginTransaction();
			try{
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
			DB::commit();
			}catch(\Exception $e){
				DB::rollback();
			}	
               return Redirect::to('admin/usergroup')->with('success','A new user group has been edited successfully.');
           }else{
               return redirect()->back()->with('fail','A group with that name does not exist in your company. Please try a group with different name.')->withInput();   
           }
		   
        }
    }
	
	public function deleteGroup($id){
		//Check that the user group exists and that it was created by the logged in user
		//The downside to this approach is that in case you inherit the groups from another admin, you will not be able to delete them unless you are logged in with his or her credentials
		//Yet the upside is that you cannot delete groups created by other admin accounts
		$userGroup = DB::select(DB::raw(
									"select user_groups.id from user_groups where user_groups.id = :groupId and user_groups.created_by = :createdBy"),
										array("groupId"=>$id,"createdBy"=>Auth::User()->id));
		//Check that there surveys in this group
		$surveysInGroup = DB::select(DB::raw(
									"select surveys.id, surveys.type_id from surveys where surveys.user_group_id = :groupId"),
										array("groupId"=>$id));
										
				   if(!empty($userGroup)){//Means the group exists
					   DB::beginTransaction();
					   try{
					   if(!empty($surveysInGroup)){//Means there are surveys in the group
						   foreach($surveysInGroup as $survey){//Iterate over each survey in the group and delete it
							   if ($survey->type_id == 1) {
									DB::delete(DB::raw(
													"delete from results where results.survey_id = :surveyId and results.survey_id is not null"),
														array("surveyId"=>$survey->id));
										
									DB::delete(DB::raw(
													"delete from participants where participants.survey_id = :surveyId and participants.survey_id is not null"),
														array("surveyId"=>$survey->id));
										
									DB::delete(DB::raw(
													"delete from surveys where surveys.id = :surveyId"),
														array("surveyId"=>$survey->id));
								}
								if ($survey->type_id == 2) {
									DB::delete(DB::raw(
													"delete from peer_results where peer_results.peer_survey_id = :surveyId and peer_results.peer_survey_id is not null"),
														array("surveyId"=>$survey->id));
										
									DB::delete(DB::raw(
													"delete from peer_surveys where peer_surveys.survey_id = :surveyId and peer_surveys.survey_id is not null"),
														array("surveyId"=>$survey->id));
										
									DB::delete(DB::raw(
													"delete from participants where participants.survey_id = :surveyId and participants.survey_id is not null"),
														array("surveyId"=>$survey->id));
										
									DB::delete(DB::raw(
													"delete from surveys where surveys.id = :surveyId"),
														array("surveyId"=>$survey->id));
								}
							}
						}
						//Now that you have removed the surveys you can delete the users in this group
						DB::delete(DB::raw(
										"delete from user_in_groups where user_in_groups.user_group_id = :groupId and user_in_groups.user_group_id is not null"),
														array("groupId"=>$id));
						//At this point it should be safe to delete the group								
						DB::delete(DB::raw(
										"delete from user_groups where user_groups.id = :groupId"),
														array("groupId"=>$id));
						
						DB::commit();
						return Redirect::to('admin/usergroup')->with('success','A user group has been deleted successfully.');
						}catch(\Exception $e){
							DB::rollback();
							return $e;
						}
					}
					
					return Redirect::to('admin/usergroup')->with('warning','A user group could not be deleted: check if you are the one who created the group.');
   	
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
