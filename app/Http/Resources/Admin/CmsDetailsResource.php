<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class CmsDetailsResource extends JsonResource
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
            'name'=> $this->name,
            'slug'=> $this->slug,
            'des' => $this->des,
            'meta_des'=>$this->meta_des,
            'meta_title'=>$this->meta_title,
            'alt_image' => $this->alt_image,
            'title_image'=>$this->title_image,
            'main_image' => $this->image,
            'image_path' => asset('uploads/images/cms')
        ];
    }
}
