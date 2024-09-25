<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AllGovResource;
use App\Http\Resources\Admin\CityWithGovResource;
use App\Http\Resources\Admin\CityWithprice;
use App\Models\Admin\citiy;
use App\Models\Admin\Governorate;
use App\Trait\ResponseTrait;
use Illuminate\Http\Request;

class GovPriceController extends Controller
{
    use ResponseTrait;
    public function get(){
    
        $govs = Governorate::whereHas('translations', function ($query) {
            $query->where('locale', '=', app()->getLocale());
        })->get();
        
        return  $this->res(true ,'All Govenment' , 200 ,AllGovResource::collection($govs));
    }

    // return all cities
    public function cities(Request $request){
        
        try{
            
            $request->validate([
                'gov_id'=>'required|integer'
            ]);
            
            $gov = Governorate::findOrFail($request->gov_id);
            $cities = citiy::where('governorate_id' , $gov->id)->whereHas('translations', function ($query) {
                $query->where('locale', '=', app()->getLocale());
            })->get();
          
            if(isset($cities) && $cities != null){
                return  $this->res(true ,'All City' , 200 ,CityWithGovResource::collection($cities));

            }

            return  $this->res(false ,'Govenment Not Exist Or Has No Cities' , 404);

        }catch(\Exception $e){
            return  $this->res(false , $e->getMessage() , $e->getCode());

        }

    } // end get cities with gov


    public function city_price(Request $request){
        try{
            
            $request->validate([
                'city_id'=>'required|integer'
            ]);
            
            $city = citiy::with(['gov' , 'price'])->where('id' , $request->city_id)->whereHas('translations', function ($query) {
                $query->where('locale', '=', app()->getLocale());
            })->first();
          
            if(isset($city) && $city != null){
                return  $this->res(true ,'City Data' , 200 , new CityWithprice($city));

            }

            return  $this->res(false ,'City Not Exist' , 404);

        }catch(\Exception $e){
            return  $this->res(false , $e->getMessage() , $e->getCode());

        }
    }




}
