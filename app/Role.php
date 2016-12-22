<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected  $fillable=['name','display_name','description'];
    public $timestamps=false;
    protected $table='roles';

    //many users can have the same permission
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
