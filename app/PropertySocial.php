<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertySocial extends Model
{
    protected $table='property_social';
    protected $fillable=[
        'id','property_id','likes','clicks','views','impressions'
    ];

    public function property(){
        return $this->belongsTo(Property::class,'property_id');
    }
}
