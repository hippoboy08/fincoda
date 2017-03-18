<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class External_Evaluators extends Model
{
	public $table='external_evaluators';
	public $dates=['created_at','updated_at'];
    protected $fillable=['invited_by_user_id','survey_id','email','confirmed','created_at','updated_at'];
	//a participant can participate in many survey
    public function survey(){
        return $this->belongsToMany(Surveys::class);
    }
    public function userParticipant(){
        return $this->belongsTo(User::class);
    }
}
