<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectShop extends Model
{
    protected $fillable = [
        'project_id',
        'name',
        'floor',
        'size',
        'size_type',
        'code',
        'type'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
