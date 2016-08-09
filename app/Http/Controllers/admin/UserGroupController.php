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

        return view('usergroup.create')->with('administrators',
            DB::table('users')->where('company_id',Auth::User()->company_id)
                ->join('role_user','role_user.user_id','=','users.id')
                ->where('role_user.role_id','=',2)
                ->whereNotIn('users.id',$id)
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


          return view('usergroup.show')->with('group',User_Group::find($id))
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

    public function validateUserGroup($id){
       if(Company::find(Auth::User()->company_id)->hasUserGroups()->where('id',$id)->exists()){
           return true;
       }else{
           return false;

       }
    }
}
