<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AgencyShort extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if($this->areaOne!=null){
        return [
            'id' => $this->id,
            'agency_name' => $this->name,
            'address'=>$this->user->address,
            'city'=>optional($this->areaOne)->city->name,
            'area_one_name'=>optional($this->areaOne)->name,
            'area_two_name'=>optional($this->areaTwo)->name,

        ];
    }
    else{
        return [
            'id' => $this->id,
            'agency_name' => $this->name,
            'address'=>$this->user->address,
            'city'=>'city unavailable',
            'area_one_name'=>optional($this->areaOne)->name,
            'area_two_name'=>optional($this->areaTwo)->name,

        ];
    }


    }
}
