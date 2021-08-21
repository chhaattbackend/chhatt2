<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AreaTwo extends JsonResource
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
            'name' => optional($this->area_one)->name.' '.$this->name,
            'parent'=>optional($this->area_one)->name.','.optional($this->area_one->city)->name,
            'key'=>'area_two_id,'.$this->id,
            'latlong' => $this->latlong,


            // 'total_properties'=>count($this->properties)
            // 'area_one' => $this->area_one,
            // 'city' => $this->area_one->city,

        ];
    }
}
