<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AllOffersReource;
use App\Http\Resources\Admin\OffersCardResource;
use App\Models\Admin\Offers;
use App\Trait\ResponseTrait;
use Illuminate\Http\Request;

class OffersController extends Controller
{
    use ResponseTrait;
    // get all offers
    public function get(){
        $offers = Offers::with('offer_products')->whereHas('translations', function ($query) {
            $query->where('locale', '=', app()->getLocale());
        })->get();

        return  $this->res(true ,'All Offers ' , 200 ,AllOffersReource::collection($offers));

    } // end get offers function 


    public function order_details(Request $request){
        try{ 
            $request->validate([
                'offer_id'=>'required|integer'
            ]);

            $offer = Offers::whereHas('translations', function ($query) {
                $query->where('locale', '=', app()->getLocale());
            })->findOrFail($request->offer_id);
            return  $this->res(true ,' Offer Details ' , 200 ,new OffersCardResource($offer));

          }catch(\Exception $e){
            return  $this->res(false , $e->getMessage() , $e->getCode() , );
        }
    }





}
