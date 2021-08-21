<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Project extends JsonResource
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
        'user_id'=>$this->user_id,
        'area_three_id'=>$this->area_three_id,
        'city'=>'Karachi',
        'name'=>$this->name,
        'address'=>$this->address,
        'project_click'=>$this->project_click,
        'price'=>$this->price,
        'description'=>$this->description,
        'image'=>'https://chhatt.s3.ap-south-1.amazonaws.com/properties/1612361727-proeprtyimage0.jpg',
        'thumbnail'=>$this->thumbnail,
        'latitude'=>$this->latitude,
        'longitude'=>$this->longitude
        ];
    }
}
