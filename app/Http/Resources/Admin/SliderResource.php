<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
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
            'slider_name'  => $this->name,
            'image_path'  => asset('/uploads/images/sliders/'),
            'slider_image'=> $this->image,
            'arrange'      => $this->arrange,
            'alt_image'    => $this->alt_image,
            'title_image'  => $this->title_image,
            'link'         => $this->link,
            'small_des'    =>$this->small_des,
            'des'          =>$this->des
        ];
    }
}
