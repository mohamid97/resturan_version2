<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class MediaGroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

    //   return  ['videos' => $this->whenLoaded('gallerys')];
    
        return [
            'title'=> $this->title,
            'image'=>$this->image,
            'image_link'=>asset('uploads/images/media_group'),
            'des'=>$this->des,
            'small_des'=>$this->small_des,
            'title_image'=>$this->title_image,
            'alt_image'=>$this->alt_image,
            'gallery'=>$this->whenLoaded('gallerys'),
            'files'=>$this->whenLoaded('files'),
            'videos'=>$this->whenLoaded('viedos'),
            
        ];
    }
}
