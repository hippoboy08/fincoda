<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    public $fillable=['survey_id','user_id','indicator_id','answer'];

    public function belonstosurvey(){
        return $this->belongsTo(Survey::class);
    }
}
