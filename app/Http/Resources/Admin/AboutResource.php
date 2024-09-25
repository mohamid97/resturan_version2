<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class AboutResource extends JsonResource
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
            'phone'=> $this->phone,
            'photo'=> asset('/uploads/images/about/' . $this->photo),
            'name'=> $this->name,
            'des'=> $this->des,
            'meta_title'=> $this->meta_title,
            'meta_des'=> $this->meta_des,
            'title_image' => $this->title_image,
            'alt_image'   => $this->alt_image,
            
        ];
    }
}
