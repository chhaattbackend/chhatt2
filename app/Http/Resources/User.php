<?php

namespace App\Http\Resources;

use App\GlobalClass;
use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $globalclass = new GlobalClass;
        if($this->agent!=null){
            $agency_id=optional($this->agent->agency)->id;
        }
        else{
            $agency_id=null;

        }

        if ($this->thumbnail == null) {
        return [
                'id' => $this->id,
                'firebase_id' => $this->firebase_id,
                'name' => $this->name,
                'phone' => $this->phone,
                'mobile' => $this->mobile,
                'email' => $this->email,
                'role' => $this->role->name,
                'image' => $globalclass->user_image_url . $this->thumbnail,
                'created_at' => $this->created_at->format('D d M Y'),
                'properties'=>count($this->properties),
                'agent'=>new Agent(optional($this->agent)),
                // 'agency'=>optional($this->agent)->agency,

            ];
        }

        if (strpos($this->thumbnail, "firebase") == null) {
            $agent=array();
            if($this->agent!=null){
                $agent=$this->agent;
            }
            return [
                'id' => $this->id,
                'firebase_id' => $this->firebase_id,
                'name' => $this->name,
                'phone' => $this->phone,
                'mobile' => $this->mobile,
                'email' => $this->email,
                'role' => $this->role->name,
                'image' => $globalclass->user_image_url . $this->thumbnail,
                'created_at' => $this->created_at->format('D d M Y'),
                'properties'=>count($this->properties),
                'agent'=>new Agent(optional($this->agent)),
                // 'agency'=>optional($this->agent)->agency,

            ];
        } else {
            return [
                'id' => $this->id,
                'firebase_id' => $this->firebase_id,
                'name' => $this->name,
                'phone' => $this->phone,
                'mobile' => $this->mobile,
                'email' => $this->email,
                'role' => $this->role->name,
                'image' => $this->thumbnail,
                'created_at' => $this->created_at->format('D d M Y'),
                'properties'=>count($this->properties),
                'agent'=>new Agent(optional($this->agent)),
                'agent'=>new Agent(optional($this->agent)),

                // 'agency'=>optional($this->agent)->agency,

            ];
        }
    }
}
