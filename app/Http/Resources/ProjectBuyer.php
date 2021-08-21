<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectBuyer extends JsonResource
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
        'id'=>$this->id,
        'name'=>$this->name,
        'project_id'=>$this->project_id,
        'contact'=>$this->contact,
        'address'=>$this->address,
        'cnic'=>$this->cnic,
        'dob'=>$this->dob
        ];
    }
}
