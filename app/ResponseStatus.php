<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResponseStatus extends Model
{
    protected $table='response_status';
    protected $fillable=['name'];
    public $timestamps=false;
}
