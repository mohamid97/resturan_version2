<?php

namespace App\Http\Resources\Admin;

use App\Models\Admin\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class OffersCardResource extends JsonResource
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
        'id'=>$this->offer->id,
        'title'=>$this->offer->title,
        'small_des'=>$this->offer->small_des,
        'des'=>$this->offer->des,
        'image_path'=>asset('/uploads/images/offers/'),
        'image'=>$this->offer->image,
        'price'=>$this->offer->price,
        'old_price'=>$this->offer->old_price,
        'offer_products'=>ProductResource::collection(Product::with('gallery')->whereIn('id' , $this->offer->offer_products->pluck('product_id'))->get())
       ];
    }
}
