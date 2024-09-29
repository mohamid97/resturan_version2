<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class FeaturedProductsResource extends JsonResource
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
            
            'id'  =>$this->product->id,
            'name'        =>$this->product->name,
            'image_path'  =>asset('uploads/images/gallery'),
            'price'       =>$this->product->price,
            'discount'    =>$this->product->discount,
            'old_price'   =>$this->product->old_price,
            'name'        =>$this->product->name,
            'des'         =>$this->product->des,
            'slug'        =>$this->product->slug,
            'gallery'     =>$this->product->gallery,
            'types'       =>TypesResource::collection($this->product->types),
            'extras'      =>ExtrasResource::collection($this->product->extras),
            'combos'      =>CombosResource::collection($this->product->combos),
        ];
    }
}



