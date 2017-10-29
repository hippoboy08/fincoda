<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Yearly_Averages extends Model
{
  public $table='yearly_averages';
	public $dates=['created_at','updated_at'];
  public $fillable=['dimension_name','type','number_of_participants','minimum_score','maximum_score','average_score','std_deviation', 'created_at', 'updated_at'];

}
