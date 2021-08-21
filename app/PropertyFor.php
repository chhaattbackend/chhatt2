<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyFor extends Model
{
    protected $table='property_for';
    protected $fillable = [
        'id',
        'name',
        'created_at',
        'updated_at'
    ];

    public $timestamps=false;
}
