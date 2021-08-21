<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaOne extends Model
{
    protected $fillable=['name','city_id','latitude','longitude'];
    protected $table='area_one';

    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }

    public function agencies(){
        return $this->hasMany(Agency::class,'area_one_id');
    }

    public function areatwos(){
        return $this->hasMany(AreaTwo::class,'area_one_id');
    }
    public function areathrees()
    {
        return $this->hasMany(AreaThree::class, 'area_two_id');
    }

    public function properties(){
        return $this->hasMany(Property::class,'area_one_id');
    }

    public function leads(){
        return $this->hasMany(Lead::class,'area_one_id');
    }

}
