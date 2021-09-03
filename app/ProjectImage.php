<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    protected $fillable = [
        'project_id',
        'name',
        'sort_order',
        'created_at',
        'updated_at',

    ];

}
