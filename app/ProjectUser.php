<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    protected $fillable=[
        'user_id',
        'project_id'
    ];

    public $timestamps=false;

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function project(){
        return $this->belongsTo(Project::class,'project_id');
    }
}
