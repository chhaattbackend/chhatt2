<?php

namespace App\Http\Resources;

use App\GlobalClass;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyImage extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $globalclass=new GlobalClass;
        // ;
        return [
            'original'=>$globalclass->base_image_url.$this->name,
            'thumbnail'=>$globalclass->base_image_url.$this->name,

            // 'sort_order'=>$this->sort_order,
        ];
    }
}
