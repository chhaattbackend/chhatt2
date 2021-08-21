<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentSpeciality extends Model
{
    protected $fillable =[
        'id','agent_id', 'speciality_id'
    ];


    public function agent(){
        return $this->belongsTo(Agent::class,'agent_id');
    }
    public function speciality(){

        return $this->belongsTo(Speciality::class,'speciality_id');
    }
}
