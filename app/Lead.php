<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'project_id',
        'name',
        'email',
        'phone',
        'description',
        'area_one_id',
        'area_two_id',
        'area_three_id',
        'area',
        'budget',
        'lead_type',
        'how_soon',
        'family_members',
        'visit_date',
        'leadsource',
        'call_status',
        'response_status',
        'property_type',
        'status',
        'created_by',
        'job_profile'
    ];

    public function areaOne(){
        return $this->belongsTo(AreaOne::class,'area_one_id');
    }
    public function areaTwo(){
        return $this->belongsTo(AreaOne::class,'area_two_id');
    }

    public function created_by1(){
        return $this->belongsTo(User::class,'created_by');
    }
}
