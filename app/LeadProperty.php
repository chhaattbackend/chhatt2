<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeadProperty extends Model
{
    protected $fillable = [
        'lead_id',
        'property_id',
        'user_id',
        'lead_status',
        'call_status',
        'chat_status',
        'message'
    ];

    public function property(){

        return $this->belongsTo(Property::class,'property_id');
    }
    public function lead(){

        return $this->belongsTo(Lead::class,'lead_id');
    }
}
