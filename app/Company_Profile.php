<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company_Profile extends Model
{

    public $table='company_profiles';
    protected $fillable=['type','country','city','street','email','phone','postcode','time_zone'];
    //each profile belongs to a company
    public function company(){
        return $this->belongsTo(Company::class);
    }
}
