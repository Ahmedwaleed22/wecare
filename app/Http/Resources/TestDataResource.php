<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TestDataResource extends JsonResource
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
            'id'        => $this->id,
            'result'    => json_decode($this->result),
            'test'      => new TestResource($this->test),
            'doctor'    => new UserResource($this->doctor),
            'patient'   => new PatientResource($this->patient)
        ];
    }
}
