<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'birth_date'    => $this->birth_date,
            'school_stage'  => $this->school_stage,
            'gender'        => $this->gender,
            'age'           => $this->age,
            'can_read'      => boolval($this->can_read),
            'doctor'        => new UserResource($this->doctor)
        ];
    }
}
