<?php

namespace App\Http\Resources\Front;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $totalPrice = $this->items->sum(function ($item) {
            return $item->quantity *  $item->product->price;
          });

       return[
        'user' => User::where('id', $this->user_id)->select('first_name' , 'last_name' , 'email' , 'type' , 'phone')->first(),
        'products'=>ItemCardResource::collection($this->items),
        'total_price'=>$totalPrice
        
       ];
    } 



}
