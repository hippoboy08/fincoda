<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    public $timestamps=false;
    public $table='indicators';

    //each indicators can appear in many surveys
    public function indicator_group(){
        $this->belongsTo(Indicator_Group::class);
    }
}
