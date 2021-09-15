<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    protected $fillable=[
        'name','id','city_id','area_one_id','area_two_id','image'
    ];
    public function areaOne()
    {

        return $this->belongsTo(AreaOne::class, 'area_one_id');
    }
    public function areaTwo()
    {

        return $this->belongsTo(AreaTwo::class, 'area_two_id');
    }
    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }

}
