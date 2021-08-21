<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Lead extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'description' => $this->description,
            'budget' => $this->budget,
            'type' => $this->type,
            'how_soon' => $this->how_soon,
            'family' => $this->family,
            'leadsource' => $this->leadsource,
            'call_status' => $this->call_status,
            'response_status' => $this->response_status,
            'property_type' => $this->property_type,
            'status' => $this->status,
            'lead_status' => $this->lead_status,
            'chat_status' => $this->chat_status,
            'created_by' => $this->created_by
        ];
    }
}
