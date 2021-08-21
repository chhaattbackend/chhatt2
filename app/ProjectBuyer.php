<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectBuyer extends Model
{
    protected $fillable = [
        'name',
        'project_id',
        'contact',
        'address',
        'cnic',
        'dob'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
