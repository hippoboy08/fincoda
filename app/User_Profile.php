<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Profile extends Model
{
    public $table='user_profiles';
    public $dates=['dob','hired_date'];
    protected $fillable=['gender','dob','country','city','street','phone','hire_date'];
    //Each user has a profile
    public function user(){
        return $this->belongsTo(User::class);
    }
}
