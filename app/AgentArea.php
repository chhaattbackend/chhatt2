<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentArea extends Model
{
    protected $fillable=[
        'agent_id',
        'area_one_id'
    ];

    public $timestamps=false;

    public function agent(){
        return $this->belongsTo(Agent::class,'agent_id');
    }
    public function areaOne(){
        return $this->belongsTo(AreaOne::class,'area_one_id');
    }
}
