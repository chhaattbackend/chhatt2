<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Callstatus extends Model
{
    protected $table='call_status';
    protected $fillable=['name'];
    public $timestamps=false;
}
