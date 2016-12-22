<?php

namespace App\Http\Controllers;

use Mail;

trait EmailTrait{

    public function email($view,$info,$member_email){

        Mail::send($view, $info, function($message) use($member_email){

            $message->to($member_email)->subject('Fincoda Survey System');

        });
    }



}