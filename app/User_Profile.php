<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Profile extends Model
{
    public $table='user_profiles';
    public $dates=['dob','hired_date'];
    protected $fillable=['user_id','gender','dob','What is your highest completed education?','Are you a student or a professional?','What level of study do you currently follow?','What type of study are you doing?','What kind of function do you aspire after your graduation?','At what stage or in which year of study indicated above are you?','What industry does your company/organization belong to?','How long has your company/organization been operating?','What type of study did you do?','What is your job role?','How big is the company / organization you work for?','country','city','street','phone','hire_date'];
    //Each user has a profile
    public function user(){
        return $this->belongsTo(User::class);
    }
}
