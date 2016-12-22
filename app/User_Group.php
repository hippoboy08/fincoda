<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Group extends Model
{
    public $table='user_groups';
    public $fillable=['name','description','company_id','created_by','administrator'];
    public function CompanyGroups(){
        return $this->belongsTo(Company::class);
    }

    public function hasMembers(){
        return $this->hasMany(User_In_Group::class,'user_group_id');
    }

    public function hasAdministrator(){
        return $this->belongsTo(User::class,'administrator');
    }
}
