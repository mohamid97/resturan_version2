<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\citiy;
use App\Models\Admin\DeliveryStatus;
use App\Models\Admin\PointsPrice;
use App\Models\Admin\Setting;
use App\Models\Front\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    // get all orders of users
    public function get(){
        $orders = Order::with(['address' , 'items.product'])->latest()->paginate(20);
 
        return view('admin.orders.index' , ['orders' => $orders]);
    }


    // order must be in pending to can delete it 
    public function delete($id){
        try{
            DB::beginTransaction();
            $order = Order::findOrFail($id);
            if($order->status == 'pending'){
                $order->delete();
                DB::commit();
                Alert::success('Success', 'Order Created Successfully ! !');
                return redirect()->route('admin.orders.index');
            }
            Alert::success('Error', 'Can not Delete This Order Now !');
            return redirect()->route('admin.orders.index');
        }catch(\Exception $e){
            DB::rollBack();
            Alert::success('Error', $e->getMessage() , $e->getCode());
            return redirect()->route('admin.orders.index');
            
        }

    } // end function delete order 


    public function show_details($id){
        $order = Order::with(['user' , 'items.product.gallery'])->findOrFail($id);

        $totalPrice = $order->items->sum(function ($item) {
            return $item->quantity *  $item->product->price;
          });


          $totla_quantity = $order->items->sum(function ($item) {
            return $item->quantity;
          });

          $order_city_price = citiy::with('price')->findOrFail($order->shipping_city_id); 

          return view('admin.orders.details' , ['order'=>$order , 'total_price'=>$totalPrice , 'total_quantity'=>$totla_quantity , 'order_city_price'=>$order_city_price]);

    }

    //edit status view
    public function edit_status($id){
        $order = Order::findOrFail($id);
        return view('admin.orders.edit_status' , ['order'=>$order]);
    }
    // update status 
    public function update_status($id , Request $request){
        
        try{
            $request->validate([
                 'status' => 'required|in:pending,proceed,on way,finshed,canceled',
                 'payment_status'=>'required|in:unpaid,paid'
            ]);
            $order = Order::with(['user' , 'items'])->findOrFail($id);
            DB::beginTransaction();
            $order->status = $request->status;
            $order->payment_status = $request->payment_status;
            $order->payment_status  = $request->payment_status;
            $order->save();

            // if order finished it check if has point
             if($request->status == 'finshed' && isset($order->user) && $order->payment_status == 'paid'){
                 $setting = Setting::first();
                 $point_price = PointsPrice::first();



                 // add point system and pounds
                if ($setting->points == 'on' && isset($point_price) && $order->total_price >= $point_price->amount) {
                    $win_points = ($order->total_price * $point_price->num_points) / $point_price->order_amount;
                    $win_points_pounds = ($win_points * $point_price->num_pounds) / $point_price->order_points;
                    $edit_user = User::find($order->user->id);
                    $edit_user->points += $win_points;
                    $edit_user->points_pound += $win_points_pounds;
                    $edit_user->save();
                }


                // change 



             }

           


            DB::commit();
            Alert::success('Success', 'Order Status Updated Successfully ! !');
            return redirect()->route('admin.orders.index');
        }catch(\Exception $e){
            DB::rollBack();
            Alert::success('Error', $e->getMessage() , $e->getCode());
            return redirect()->route('admin.orders.index');
            
        }

    } // end edit status



    public function hire_delivery($id){

        // hire delivery
        $order = Order::with('delivery')->where('status' , 'on way')->findOrFail($id);
        $delivery = User::where('type', 'delivery')
        ->get();
        $delivery_man = DeliveryStatus::with('user')->where('order_id' , $id)->first();
        return view('admin.orders.hire_delivery' , ['order'=>$order , 'delivery'=>$delivery , 'delivery_man'=>$delivery_man ]);
        
    }

    public function hire_delivery_store($id , Request $request){

        $request->validate([
            'delivery_id'=>'required|numeric|gt:0'
        ]);
        $order = Order::findOrFail($id);

        // check first if order has order delivery 
        $old_delivery = DeliveryStatus::where('order_id' , $id)->first();
        if(isset( $old_delivery )){
            $old_delivery->update([
                'user_id' => $request->delivery_id,
            ]);

            Alert::success('Success', 'Order delivery hire  Successfully !');
            return redirect()->route('admin.orders.index');
        }


        // if order didnot have delivery man before
 

           DeliveryStatus::create([
            'user_id' => $request->delivery_id,
            'order_id'=>$id,
            'status'=>'on way'
           ]);
           Alert::success('Success', 'Order delivery hire  Successfully !');
           return redirect()->route('admin.orders.index');



    }



}
