<?php

namespace App\Http\Controllers\admin;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Query;
use App\User_Profile;
use Illuminate\Support\Facades\DB;


class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Auth::User()->company()->first();

        return view('members.index')
            ->with('company', $company)
            ->with('members',DB::table('users')->where('company_id',$company->id)
            ->join('role_user','role_user.user_id','=','users.id')
            ->join('roles','roles.id','=','role_user.role_id')
            ->select('users.name','users.email','users.created_at','roles.display_name','users.id')->get());

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
    $role=DB::table('role_user')->where('user_id',$id)
            ->join('roles','roles.id','=','role_user.role_id')
            ->select('roles.display_name')
            ->first();
    if($this->validateUser($id)=='true'){
        return view('profile.user')->with('user',User::find($id))
                                    ->with('profile',User_Profile::where('user_id',$id)->first())
                                    ->with('role',$role);


    }else{
        return view('errors.404')->with('title',' User not found')->with('message','The user you requested does not belong to your company or does not exists in Fincoda Survey System.');
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
    public function validateUser($id){
        $company_auth=Auth::User();
        if(User::where('id',$id)->exists()){
            $user=User::find($id);
            if($user->company_id==$company_auth->company_id){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }




    }
}
