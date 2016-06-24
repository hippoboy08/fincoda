<?php

namespace App\Http\Controllers\basic;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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
}
