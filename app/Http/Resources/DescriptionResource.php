<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DescriptionResource extends JsonResource
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
            'image'=>$this->image,
            'name'=>$this->name,
            'des'=>$this->des,
            'alt_image'=>$this->alt_image,
            'title_image'=>$this->title_image,
            'image_link'=>asset('uploads/images/des')
        ];
    }
}
