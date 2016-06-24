<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable=['survey_id','user_id','completed','reminder'];
    //a participant can participate in many survey
    public function survey(){
        return $this->belongsToMany(Surveys::class);
    }
    public function userParticipant(){
        return $this->belongsTo(User::class);
    }
}
