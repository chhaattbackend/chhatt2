<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeadProject extends Model
{
    protected $fillable = [
        'lead_id',
        'project_id',
        'user_id',
        'lead_status',
        'call_status',
        'chat_status'
    ];

    public function project(){

            return $this->belongsTo(Project::class,'project_id');
    }
    public function lead(){
        return $this->belongsTo(Lead::class,'lead_id');
    }  
}
