<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable =[
        'id','name', 'state_id'
    ];

    public function state(){
        return $this->belongsTo(State::class,'state_id');
    }

    public function areaOne(){
        return $this->hasMany(AreaOne::class,'city_id');
    }
}
