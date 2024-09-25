<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\CouponsResource;
use App\Models\Admin\Coupon;
use App\Models\Admin\CouponUser;
use App\Trait\ResponseTrait;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CouponsController extends Controller
{
    use ResponseTrait;


    //get all coupons
   public function get(){
        $coupons = Coupon::whereHas('translations', function ($query) {
            $query->where('locale', '=', app()->getLocale());
        })->get();
        return  $this->res(true ,'All Coupons ' , 200 ,CouponsResource::collection($coupons));
   }

   public function coupon_details(Request $request){
     
     try{
      $request->validate([
         'coupon_code'=>'required|string'
      ]);

          // Get the current date and time
       $currentDate = Carbon::now('Africa/Cairo');
        $user = $request->user();
        $coupon = Coupon::where('code', $request->coupon_code)->first();
        if(!isset($coupon)){
         return  $this->res(true ,'Invaild Coupon' , 400);
        }
        $coupon_user = CouponUser::where('coupon_id' , $coupon->id)->where('user_id' , $user->id)->first();
         // Parse the start_date and end_date using Carbon
         $startDate = Carbon::parse($coupon->start_date);
         $endDate = Carbon::parse($coupon->end_date);
        if(isset($coupon_user) || !$currentDate->between($startDate, $endDate)){
          return  $this->res(true ,'Invaild Coupon' , 400);
        }

        return  $this->res(true ,'coupon details' , 200 ,new CouponsResource($coupon));

     }catch(\Exception $e){
        return  $this->res(false ,$e->getMessage() , $e->getCode());
     }

   } // end coupon details





}
