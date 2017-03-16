<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Yearly_Averages extends Model
{
    public $table='yearly_averages';
	public $dates=['created_at','updated_at'];
    public $fillable=['creativity','critical_thinking','initiative','teamwork','networking','created_at','updated_at'];

}
