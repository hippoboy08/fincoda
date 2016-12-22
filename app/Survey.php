<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{

    protected $fillable=['title','description','end_message','user_id','type_id','start_time','end_time','company_id','category_id','user_group_id'];
    //each survey has indicators
    public function indicators(){
        return $this->belongsTo();
    }

    //One survey can be of only one type
    public function survey_type(){
        return $this->belongsTo(Survey_Type::class);
    }

    // a survey has many participants
    public function participants(){
        return $this->hasMany(Participant::class);
    }

    //a survey is owned by a owner
    public function owner(){
        return $this->belongsTo(User::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function results(){
        return $this->hasMany(Result::class);
    }

}
