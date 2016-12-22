<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;



class HomeController extends Controller
{
    public function homepage(){

        if(Auth::check()){
            if(Auth::User()->hasRole('admin')){
                return Redirect::to('admin');
            }elseif(Auth::User()->hasRole('special')){
                return Redirect::to('special');
            }else{
                return Redirect::to('basic');
            }
        }
      else{
            return view('home');
        }
    }

    public function loginpage(){
        if(Auth::check()) {
            if (Auth::User()->hasRole('admin')) {
                return Redirect::to('admin');
            } elseif (Auth::User()->hasRole('special')) {
                return Redirect::to('special');
            } else {
                return Redirect::to('basic');
            }
        }else{
           return view('login');
       }
    }
}
