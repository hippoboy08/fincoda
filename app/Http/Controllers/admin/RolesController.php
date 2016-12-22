<?php

namespace App\Http\Controllers\admin;

use App\Role_User;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Database\Query;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class RolesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('roles.index')->with('users',DB::table('users')
        ->where('company_id',Auth::User()->company_id)
        ->where('users.id','!=',Auth::id())
        ->join('role_user','role_user.user_id','=','users.id')
        ->join('roles','roles.id','=','role_user.role_id')
        ->select('users.name','users.id','users.email','roles.display_name')
            ->get()
        );
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
        if($this->ValidateUser($id) ){
          if($this->ValidateRole($id)){
              return view('roles.show')->with('role',DB::table('role_user')->where('user_id',$id)
                  ->join('roles','roles.id','=','role_user.role_id')
                  ->first()
              );
          }else{
              return view('errors.404')->with('title',' Action denied')->with('message','Sorry ! You can not change your own role.');
          }
        }else{
            return view('errors.404')->with('title',' User not found')->with('message','The user you requested does not exists in the Fincoda Survey System.');
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

        $user=DB::table('role_user')->where('user_id',$id)->get();
        User::find($id)->roles()->detach($user[0]->role_id);
        User::find($id)->attachRole($request->role);
        return Redirect::to('admin/roles')->with('success','The role of the user has been updated successfully.');

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

    public function ValidateUser($id){
       if(User::where('id',$id)->exists() && Auth::User()->company_id==User::find($id)->company_id){
                return true;
            }else{
                return false;
            }
    }

    public function ValidateRole($id){
        if(Auth::id()==$id){
            return false;
        }else
        {
            return true;
        }
    }
}
