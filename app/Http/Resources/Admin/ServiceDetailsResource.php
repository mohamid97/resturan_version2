<?php

namespace App\Http\Resources\Admin;

use App\Models\Admin\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $galleryData = $this->gallery->map(function ($item) {
            return [
                'photo' => $item->photo,
                'image_link'=>asset('/uploads/images/service/')
            ];
        });
        return [
            'name'      =>$this->name,
            'des'       =>$this->des,
            'meta_title'=>$this->meta_title,
            'meta_des'  =>$this->meta_des,
            'slug'      =>$this->slug,
            'image'     => $this->image,
            'alt_image'=>$this->alt_image,
            'title_image'=>$this->title_image,
            'small_des'=>$this->small_des,
            'photos'    => $galleryData,
            'category'    => new CategoryDetailsResource(Category::find($this->category_id))

        ];
    }
}
