<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\Front\ItemCardResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CartWithOptionResource extends JsonResource
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
            'user_id'=>$this->user_id,
            'products'=>ItemCardOptionResource::collection($this->items),

        ];
    }
}
