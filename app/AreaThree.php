<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaThree extends Model
{
    protected $fillable=['name','area_two_id','area_one_id','latitude','longitude'];
    protected $table='area_three';

    public function area_one(){
        return $this->belongsTo(AreaOne::class,'area_one_id');
    }
    public function area_two(){
        return $this->belongsTo(AreaTwo::class,'area_two_id');
    }

    public function agencies(){
        return $this->hasMany(Agency::class,'area_three_id');
    }

    public function areatwos(){
        return $this->hasMany(AreaTwo::class,'area_three_id');
    }

    public function properties(){
        return $this->hasMany(Property::class,'area_three_id');
    }

    public function leads(){
        return $this->hasMany(Lead::class,'area_three_id');
    }

}
