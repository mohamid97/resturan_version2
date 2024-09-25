<?php

namespace App\Http\Resources\Admin;

use App\Models\Admin\Governorate;
use Illuminate\Http\Resources\Json\JsonResource;

class UserAddressResource extends JsonResource
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
            'user'=>[
            'name'=> $this->first_name . ' ' .$this->last_name,
            'email'=>$this->email
            ],
            'address'=>AddressResource::collection($this->address->load(['gov' , 'city'])),

        ];
    }
}
