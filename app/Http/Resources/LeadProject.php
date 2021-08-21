<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LeadProject extends JsonResource
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
            'project_id' => $this->project_id,
            'user_id' => $this->user_id,
            'lead_status' => $this->lead_status,
            'call_status' => $this->call_status,
            'chat_status' => $this->chat_status,
            'project' => [
                'name' => $this->project->name,
                'address' => $this->project->address,
                'longitude' => $this->project->longitude,
                'latitude' => $this->project->latitude,
            ],
            'owner' => [
                'name' => $this->project->user->name,
                'contact' => $this->project->user->phone,

            ],

        ];
    }
}
