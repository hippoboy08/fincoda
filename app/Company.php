<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Company extends Model
{
    protected  $fillable=['name','company_code','slug'];

    //A company has many user
    public function members(){
       return $this->hasMany(User::class);
    }
    //Each of the company has a profile
    public function profile(){
        return $this->hasOne(Company_Profile::class);
    }
    public function hasSurveys(){
        return $this->hasMany(Survey::class);
    }
    public function hasUserGroups(){
        return $this->hasMany(User_Group::class);
    }

}
