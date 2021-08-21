<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectShop extends JsonResource
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
        'project_id'=>$this->project_id,
        'name'=>$this->name,
        'floor'=>$this->floor,
        'size'=>$this->size,
        'size_type'=>$this->size_type,
        'code'=>$this->code,
        'type'=>$this->type
        ];
    }
}
