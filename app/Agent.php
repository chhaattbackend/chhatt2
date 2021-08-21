<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Agent extends Model
{
    protected $fillable =[
        'id','user_id', 'agency_id','position_id'
    ];
    public function position(){
        return $this->belongsTo(Position::class,'position_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function agency(){
        return $this->belongsTo(Agency::class,'agency_id');
    }
    public function specialities(){
        return $this->hasMany(AgentSpeciality::class,'agent_id');
    }
    public function workingAreas(){
        return $this->hasMany(AgentArea::class,'agent_id');
    }
    public function properties(){
        return $this->hasMany(Property::class,'user_id');
    }
}
