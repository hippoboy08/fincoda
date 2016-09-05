<?php

namespace App\Http\Controllers\special;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    public function index(){

        $role=DB::table('role_user')->where('user_id',Auth::id())
            ->join('roles','roles.id','=','role_user.role_id')
            ->select('roles.display_name')
            ->first();
        return view('profile.user')->with('user',Auth::User())->with('profile',Auth::User()->profile)->with('role',$role);
    }
    public function edit($id){
        return view('profile.edituser')->with('profile',Auth::User()->profile)->with('user',Auth::User());
    }
    public function update(Request $request, $id){
        if(Auth::id()==$id){



            $validation=Validator::make($request->all(),[
                'name'=>'required|max:255'
            ]);

            if($validation->fails()){
                return redirect()->back()->withErrors($validation)->withInput();
            }else{

                $user=Auth::User()->first();
                $user->name=$request->name;
                $user->save();


                $profile=Auth::User()->profile()->first();
                $profile->gender=$request->gender;
                $profile->country=$request->country;
                $profile->city=$request->city;
                $profile->street=$request->street;
                $profile->phone=$request->phone;
                $profile->save();

                return redirect()->back()->with('success','Your profile has been updated successfully');
            }


        }else{
            return 'Unauthentic user. The profile could not be updated';
        }
    }
}
