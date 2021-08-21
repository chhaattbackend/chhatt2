<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyGroup extends Model
{
    protected $fillable = [
        'name', 
        'link',
        'social_type'
    ];

    public function getType() {
        return $this->belongsTo(SocialType::class, 'social_type');
    }
}