<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LeadProperty extends JsonResource
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
            'lead_id'=>$this->lead_id,
            'property_id'=>$this->property_id,
            'user_id'=>$this->user_id,
            'lead_status'=>$this->lead_status,
            'call_status'=>$this->call_status,
            'chat_status'=>$this->chat_status
            ];
    }
}
