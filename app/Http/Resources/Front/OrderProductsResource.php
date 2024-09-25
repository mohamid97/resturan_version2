<?php

namespace App\Http\Resources\Front;

use App\Http\Resources\Admin\ProductResource;
use App\Models\Admin\Offers;
use App\Models\Admin\Product;
use App\Models\Front\Order;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
     
        if($this->type == 'normal' && !isset($this->offer_id)){

            $pro = Product::with('gallery')->whereHas('translations', function ($query)  {
                $query->where('locale', '=', app()->getLocale());
            })->where('id' , $this->product_id)->first();
       
                return [
                        'normal_product'=>[
                            'product_name'=> $pro->name,
                            'quantity'=>$this->quantity,
                            'price'=>$this->price,
                            'type'=>'normal',
                            'slug'=>$pro->slug,
                            'gallery'=>$pro->gallery
                        ]
                ];

        }else{

                $offer = Offers::with('offer_products')->find($this->offer_id);
                $productIds = $offer->offer_products->pluck('product_id');
                $products = Product::with('gallery')->whereIn('id', $productIds)->get();
               
                return [
                    'offer_products'=>[
                        'type'=>'offer',
                        'offer_name'=>$offer->title,
                        'small_des'=>$offer->small_des,
                        'des'=>$offer->small_des,
                        'products'=>ProductResource::collection($products)
                    ]


                ];
            
            
            

        }








    }









}
