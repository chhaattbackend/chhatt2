<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AgentSpeciality extends JsonResource
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
            'id' => optional($this->speciality)->id,
            // 'agent' => optional($this->agent->user)->name,
            'name' => optional($this->speciality)->name
        ];
    }
}
