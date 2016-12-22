<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicator_Group extends Model
{
    public $timestamps=false;
    public $table='indicator_groups';

    //Each indicator group has many
    public function indicator(){
        return $this->hasMany(Indicator::class);

    }
}
