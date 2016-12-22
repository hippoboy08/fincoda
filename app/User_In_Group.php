<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_In_Group extends Model
{
    public $table='user_in_groups';
    public $fillable=['user_id','user_group_id'];

    public function relatedGroup(){
        return $this->belongsTo(User_Group::class);
    }

    public function hasUsers(){
        return $this->belongsTo(User::class);
    }
}
