<?php

namespace App\Http\Resources\Front;

use App\Models\Admin\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemCardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $product = Product::with('gallery')->where('id' , $this->product_id)->first();

       return[
            'id'=>$product->id,
            'slug'=>$product->slug,
            'price'=>$product->price,
            'discount'=>$product->discount,
            'old_price'=>$product->old_price,
            'product_name'=>$product->name,
            'quantity'=> $this->quantity,
            'gallery' => $product->gallery,
            'total_price'=>$this->quantity * $product->price,
       ];
    }
}
