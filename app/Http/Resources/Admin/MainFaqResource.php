<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class MainFaqResource extends JsonResource
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
         'image'=> $this->image,
         'image_link'=>asset('uploads/images/main_faq'),
         'title_image'=> $this->title_image,
         'alt_image'  => $this->alt_image,
         'des'        => $this->des,
         'title'      => $this->title,
         
       ];
    }
}
