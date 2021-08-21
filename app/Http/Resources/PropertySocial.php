<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertySocial extends JsonResource
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
            // 'id'=>$this->id,
            // 'property_id'=>$this->property_id,
            'likes'=>$this->likes,
            'clicks'=>$this->clicks,
            'views'=>$this->views,
            'impressions'=>$this->impressions,
        ];
    }
}
