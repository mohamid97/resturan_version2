<?php

namespace App\Http\Resources\Admin;

use App\Models\Admin\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class AllOffersReource extends JsonResource
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
            'title'=>$this->title,
            'small_des'=>$this->small_des,
            'des'=>$this->des,
            'old_price'=>$this->old_price,
            'price'=>$this->price,
            'image'=>$this->image,
            'image_path'=>asset('uploads/images/offers'),
            'offer_products'=>ProductResource::collection(Product::with('gallery')->whereIn('id' , $this->offer_products->pluck('product_id'))->get())
            
        ];
    }
    
}
