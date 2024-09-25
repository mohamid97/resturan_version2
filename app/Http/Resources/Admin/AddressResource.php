<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id'=>$this->id,
            'address'=>$this->address,
            'is_default'=>$this->default,
            'gov'=>$this->whenLoaded('gov'),
            'user'=>$this->whenLoaded('user'),
            'city'=>$this->whenLoaded('city'),
        ];
    }
}
