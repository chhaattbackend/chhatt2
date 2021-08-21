<?php
namespace App\Http\Resources;
use App\GlobalClass;
use Illuminate\Http\Resources\Json\JsonResource;
class Agent extends JsonResource
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
        $agency_address = null;
        if ($this->agency != null) {
            $agency_address = optional($this->agency->user)->address;
        }
        // dd($this->specialities);
        if ($this->id != null) {
            if (optional($this->user)->thumbnail == null) {
                return [
                    'id' => $this->id,
                    'user_id' => $this->user_id,
                    'agency_id' => $this->agency_id,
                    'agency_name' => optional($this->agency)->name,
                    'agency_address' => $agency_address,
                    'name' => optional($this->user)->name,
                    'contact' => optional($this->user)->phone,
                    'email' => optional($this->user)->email,
                    'image' => '',
                    'position_id' => $this->position_id,
                    'specialities' => AgentSpeciality::collection($this->specialities),
                    'working_areas' => AgentArea::collection($this->workingAreas)
                ];
            } else if (strpos(optional($this->user)->thumbnail, "firebase") == null) {
                return [
                    'id' => $this->id,
                    'user_id' => $this->user_id,
                    'firebase_id' => optional($this->user)->firebase_id,
                    'agency_id' => $this->agency_id,
                    'agency_name' => optional($this->agency)->name,
                    'agency_address' => $agency_address,
                    'name' => optional($this->user)->name,
                    'contact' => optional($this->user)->phone,
                    'email' => optional($this->user)->email,
                    'image' => $globalclass->user_image_url . optional($this->user)->thumbnail,
                    'position_id' => $this->position_id,
                    'specialities' => AgentSpeciality::collection($this->specialities),
                    'working_areas' => AgentArea::collection($this->workingAreas),
                    'totalproperties' => count($this->properties),
                ];
            } else {
                return [
                    'id' => $this->id,
                    'user_id' => $this->user_id,
                    'firebase_id' => optional($this->user)->firebase_id,
                    'agency_id' => $this->agency_id,
                    'agency_name' => optional($this->agency)->name,
                    'agency_address' => $agency_address,
                    'name' => optional($this->user)->name,
                    'contact' => optional($this->user)->phone,
                    'email' => optional($this->user)->email,
                    'image' => optional($this->user)->thumbnail,
                    'position_id' => $this->position_id,
                    'specialities' => AgentSpeciality::collection($this->specialities),
                    'working_areas' => AgentArea::collection($this->workingAreas),
                    'totalproperties' => count($this->properties),
                ];
            }
        } else {
            return [
                'id' => $this->id,
                'user_id' => $this->user_id,
                'agency_id' => $this->agency_id,
                'agency_name' => optional($this->agency)->name,
                'agency_address' => $agency_address,
                'name' => optional($this->user)->name,
                'contact' => optional($this->user)->phone,
                'email' => optional($this->user)->email,
                'image' => $globalclass->user_image_url . optional($this->user)->thumbnail,
                'position_id' => $this->position_id,
                // 'specialities' =>AgentSpeciality::collection($this->specialities),
                // 'working_areas' =>AgentArea::collection($this->workingAreas)
            ];
        }
    }
}
