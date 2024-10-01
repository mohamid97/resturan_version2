<?php

namespace App\Http\Resources\Admin;

use App\Models\Admin\CartItemsExtras;
use App\Models\Admin\CartItemsTypes;
use App\Models\Admin\Combo;
use App\Models\Admin\Product;
use App\Models\Front\CardItem;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemCardOptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

 
        $product = Product::with('gallery')->find($this->product_id);
        $itemTypes = CardItem::with(['types' , 'options'])->find($this->id);
        $itemsExtra = CardItem::with('extras')->find($this->id);

        return[
            'cart_id'=>$this->id,
             'id'=>$product->id,
             'slug'=>$product->slug,
             'price'=>$product->price,
             'discount'=>$product->discount,
             'old_price'=>$product->old_price,
             'product_name'=>$product->name,
             'quantity'=> $this->quantity,
             'gallery' => $product->gallery,
             'combos'=> new CombosResource(Combo::find($this->combo_id)),
             'extras'=> ExtrasResource::collection($itemsExtra->extras),
             'types'=> TypeCardnResource::collection($itemTypes->types),
      
        ];
    }
    
}
