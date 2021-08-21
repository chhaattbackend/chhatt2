<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AreaThree extends JsonResource
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
            'parent'=>optional($this->area_two)->name.','.optional($this->area_one)->name.','.optional($this->area_one->city)->name,
            'key'=>'area_three_id,'.$this->id,
            // 'total_properties'=>count($this->properties)


        ];
    }
}
