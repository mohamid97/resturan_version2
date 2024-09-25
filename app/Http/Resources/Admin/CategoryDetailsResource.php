<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryDetailsResource extends JsonResource
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
          
            'name'=>$this->name,
            'des'=>$this->des,
            'type'=>($this->type != 0) ? 'Child' :'Parent',
            'image_name'=> $this->photo,
            'image_path'=> asset('/uploads/images/category/'),
            'alt_image' => $this->alt_image,
            'title_image'=>$this->title_image,
            'parent_id' => $this->parent_id,
            'small_des' => $this->small_des,
            'meta_title' => $this->meta_title,
            'meta_des'   => $this->meta_des,
            'slug'=>$this->slug
            
        ];
    }
}
