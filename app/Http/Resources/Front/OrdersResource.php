<?php

namespace App\Http\Resources\Front;

use App\Http\Resources\Admin\AddressResource;
use App\Http\Resources\Admin\AllOffersReource;
use App\Http\Resources\Admin\CityWithprice;
use App\Http\Resources\Admin\OrderAddressResource;
use App\Http\Resources\Admin\ProductResource;
use App\Models\Admin\CitiyPrice;
use App\Models\Admin\Offers;
use App\Models\Admin\Product;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersResource extends JsonResource
{
    public $all_normal_products = [];
    public $all_offer_products = [];
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $city = CitiyPrice::where('citiy_id' , $this->shipping_city_id)->first();
        $normalItems = $this->items->where('type', 'normal');
        $offerItems = $this->items->where('type', 'offer');
        $this->get_normal_products($normalItems);
        $this->get_offer_products($offerItems);


        return [
            'order'=>$this->id,
            'status'=>$this->status,
            'payment_method'=>$this->payment_method,
            'payment_status'=>$this->payment_status,
            'total_price'=>$this->total_price,
            'old_price'=>$this->old_price,
            'shipping_cost'=>isset($city->price) ? $city->price : null,
            'created_at' =>  Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'products'=> $this->all_normal_products,
            'offers'  => $this->all_offer_products,
            'address'=> new OrderAddressResource($this->address->load(['gov' , 'city']))
        ];
    }

    public function get_normal_products($normalItems){
        
        foreach($normalItems as $normal){
            
            $product = Product::with('gallery')->find($normal->product_id);
        
            if($product){
                $this->all_normal_products[] = [
                    'name'=>$product->name,
                    'id'=>$product->id,
                    'price'=>$normal->price,
                    'quantity'=>$normal->quantity,
                    'gallery'=>$product->gallery
    
                ];
            }

        }
        
    } 


    public function get_offer_products($offerItems){
        
        foreach($offerItems as $off){
            
            $offer = Offers::with('offer_products')->find($off->offer_id);
            if(isset($offer)){
                $this->all_offer_products[] = [
                    'offer_title'=>$offer->title,
                    'offer_price'=>$off->price,
                    'products'=>ProductResource::collection(Product::with('gallery')->whereIn('id' , $offer->offer_products->pluck('product_id'))->get())
    
                ];
            }

        }
        
    }



}
