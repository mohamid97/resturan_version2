<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\OptionsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TypesResource extends JsonResource
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
            'id'=>$this->id,
            'name'=>$this->name,
            'small_des'=>$this->small_des,
            'des'=>$this->des,
            'options'=>OptionsResource::collection($this->options)

        ];
    }
}
