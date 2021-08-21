<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeadAssign extends Model
{
    protected $table = 'lead_assign';
    protected $fillable = [
        'agent_id',
        'lead_id',
        'client_feedback',
        'realtor_feedback',
        'chat_status',
        'lead_status',
        'call_status',
    ];

    public function agent()
    {

        return $this->belongsTo(Agent::class, 'agent_id');
    }

    public function user()
    {

        return $this->belongsTo(User::class, 'agent_id');
    }

    public function lead()
    {

        return $this->belongsTo(Lead::class, 'lead_id');
    }
}
