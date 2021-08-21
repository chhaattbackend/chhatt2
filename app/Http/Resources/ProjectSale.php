<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectSale extends JsonResource
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
        'shop_id'=>$this->shop_id,
        'buyer_id'=>$this->buyer_id,
        'price'=>$this->price
        ];
    }
}
