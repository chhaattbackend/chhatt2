<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'user_id',
        'area_three_id',
        'name',
        'address',
        'message',
        'project_click',
        'price',
        'description',
        'image',
        'thumbnail',
        'latitude',
        'longitude'
    ];

    public function leads()
    {
        return $this->hasMany(Lead::class, 'project_id');
    }
    public function area_three()
    {
        return $this->belongsTo(AreaThree::class, 'area_three_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
