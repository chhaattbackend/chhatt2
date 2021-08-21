<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AreaOne extends JsonResource
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
            'parent'=>optional($this->city)->name,
            'key'=>'area_one_id,'.$this->id,
            // 'total_properties'=>count($this->properties)
        ];
    }
}
