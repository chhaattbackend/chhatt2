<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LeadAssign extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'lead_id' => $this->lead_id,
            'agent_id' => $this->agent_id,
            'name' => $this->lead->name,
            'email' => $this->lead->email,
            'phone' => $this->lead->phone,
            'description' => $this->lead->description,
            'budget' => $this->lead->budget,
            'type' => $this->lead->type,
            'how_soon' => $this->lead->how_soon,
            'family' => $this->lead->family,
            'leadsource' => $this->lead->leadsource,
            'call_status' => $this->lead->call_status,
            'response_status' => $this->lead->response_status,
            'property_type' => $this->lead->property_type,
            'status' => $this->lead->status,
            'lead_status' => $this->lead->lead_status,
            'chat_status' => $this->lead->chat_status,
            'created_by' => $this->lead->created_by
        ];
    }
}
