<?php

namespace App;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{


    protected $fillable = [
        'id', 'user_id', 'name', 'status', 'verified', 'area_three_id', 'area_two_id', 'area_one_id','major_area','minor_area','image'
    ];


    public function user()
    {

        return $this->belongsTo(User::class, 'user_id');
    }

    public function areaOne()
    {

        return $this->belongsTo(AreaOne::class, 'area_one_id');
    }
    public function areaTwo()
    {

        return $this->belongsTo(AreaTwo::class, 'area_two_id');
    }
    public function areaThree()
    {

        return $this->belongsTo(AreaThree::class, 'area_three_id');
    }
    public function agents()
    {
        return $this->hasMany(Agent::class, 'agency_id');
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'agency_id');
    }

    
}
