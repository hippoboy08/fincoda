<?php

namespace App\Http\Controllers\basic;

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
            ->select('roles.display_name')->first();

        return view('profile.user')->with('user',Auth::User())
            ->with('profile',Auth::User()->profile)
            ->with('role',$role);
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
				DB::beginTransaction();
				try{
					DB::table('users')
								->where('id',Auth::User()->id)
								->update([
									'name'=>$request->name
						]);
						
					DB::table('user_profiles')
								->where('user_id',Auth::User()->id)
								->update([
									'gender'=>$request->gender,
									'country'=>$request->country,
									'city'=>$request->city,
									'street'=>$request->street,
									'phone'=>$request->phone
						]);
					DB::commit();
					return redirect()->back()->with('success','Your profile has been updated successfully');
					}catch(\Exception $e){
					DB::rollback();
					}
            }


        }else{
            return 'Unauthentic user. The profile could not be updated';
        }
    }
}
