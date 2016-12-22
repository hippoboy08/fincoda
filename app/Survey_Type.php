<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey_Type extends Model
{
    public $timestamps=false;
    public $table='survey_types';
    public $fillable=['name'];

    //Each survey type has many surveys.

    public function survey(){
        return $this->hasMany(Surveys::class);
    }
}
