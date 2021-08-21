<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Agency extends JsonResource
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
            'owner_name' => $this->user->name,
            'owner_contact' => $this->user->mobile,
            'address' => $this->user->address,
            'totalagents' => count($this->agents),
            'totalproperties' => count($this->properties),
            'status' => $this->status,
            'verified' => $this->verified,
            'area_one_id' => $this->area_one_id,
            'area_two_id' => $this->area_two_id,
            'area_three_id' => $this->area_three_id,
            'area_one_name' => optional($this->areaOne)->name,
            'area_two_name' => optional($this->areaTwo)->name,
            'area_three_name' => optional($this->areaThree)->name,
            'city' => optional($this->areaOne->city)->name,
            'image'=>'https://chhatt.s3.ap-south-1.amazonaws.com/agencies/'.$this->image,
            'agents' => Agent::collection($this->agents),
        ];
    }
    else{
        return [
            'id' => $this->id,
            'agency_name' => $this->name,
            'owner_name' => $this->user->name,
            'owner_contact' => $this->user->mobile,
            'address' => $this->user->address,
            'totalagents' => count($this->agents),
            'totalproperties' => count($this->properties),
            'status' => $this->status,
            'verified' => $this->verified,
            'area_one_id' => $this->area_one_id,
            'area_two_id' => $this->area_two_id,
            'area_three_id' => $this->area_three_id,
            'area_one_name' => optional($this->areaOne)->name,
            'area_two_name' => optional($this->areaTwo)->name,
            'area_three_name' => optional($this->areaThree)->name,
            'city' => 'Karachi',
            'image'=>'https://chhatt.s3.ap-south-1.amazonaws.com/agencies/'.$this->image,
            'agents' => Agent::collection($this->agents),
        ];
    }
    }
}
