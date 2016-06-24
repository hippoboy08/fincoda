<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustPermissionTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;



class User extends Authenticatable
{

    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','company_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //user has only one role - admin/special/basic
    public function role(){
        return $this->belongsTo(Role::class);
    }

    //check if the user has a role - true or flase
    public function hasRole($value)
    {
        return $this->roles()->where('name', $value)->exists();
    }

    public function attachRole($id){
        return $this->roles()->attach($id);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    //Each user has a profile
    public function profile(){
        return $this->hasOne(User_Profile::class);
    }

    //admin creates surveys
    public function creates_survey(){
        return $this->hasMany(Survey::class);
    }

    public function participate_survey(){
        return $this->hasMany(Participant::class);
    }

    public function answer_survey(){
        return $this->hasMany(Result::class);
    }
    public function associated_groups(){
        return $this->hasMany(User_In_Group::class);
    }
}
