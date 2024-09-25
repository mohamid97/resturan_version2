<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\UsersResource;
use App\Http\Resources\Front\OrdersResource;
use App\Models\Admin\DeliveryStatus;
use App\Models\Front\Order;
use App\Models\User;
use App\Trait\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;



class DeliveryController extends Controller
{

    use ResponseTrait;


    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $user = User::where('email', $request->email)->where('type' , 'delivery')->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return  $this->res(false ,'Invaild Login creedintenal' , 401);

        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return  $this->res(true ,'access_token' , 200 ,['token'=>$token , 'token_type' => 'Bearer' ,  'user'=>$user]);
    }
    // get pending order
    public function get_on_way_order(Request $request){
        $user = $request->user();
        $orders = Order::whereHas('delivery', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['items', 'user' , 'address'])->where('status' , 'on way')->paginate(15);

        return  $this->res(true, 'Get On Way Orders Details!', 200, [
            'orders'=> OrdersResource::collection($orders),
            'meta' => [
                'total' => $orders->total(),
                'count' => $orders->count(),
                'per_page' => $orders->perPage(),
                'current_page' => $orders->currentPage(),
                'last_page' => $orders->lastPage(),
                'next_page_url' => $orders->nextPageUrl(),
                'prev_page_url' => $orders->previousPageUrl(),
            ],
        ]);
        

        
    }

    // get deliverd order
    public function get_delivered_order(Request $request){
        $user = $request->user();
        $orders = Order::whereHas('delivery', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['items', 'user' , 'address'])->where('status' , 'delivered')->paginate(15);

        return  $this->res(true, 'Get delivered  Orders Details!', 200, [
            'orders'=>OrdersResource::collection($orders) ,    
            'meta' => [
            'total' => $orders->total(),
            'count' => $orders->count(),
            'per_page' => $orders->perPage(),
            'current_page' => $orders->currentPage(),
            'last_page' => $orders->lastPage(),
            'next_page_url' => $orders->nextPageUrl(),
            'prev_page_url' => $orders->previousPageUrl(),
            ]
        ]);

    }


    // get finished order
    public function get_finish_order(Request $request){
        $user = $request->user();
        $orders = Order::whereHas('delivery', function($query ) use ($user)  {
            $query->where('user_id', $user->id);
        })->with(['items', 'user' , 'address'])->where('status' , 'finshed')->paginate(15);
        return  $this->res(true, 'Get finshed  Orders Details!', 200,  [
            'orders'=>OrdersResource::collection($orders) ,    
            'meta' => [
            'total' => $orders->total(),
            'count' => $orders->count(),
            'per_page' => $orders->perPage(),
            'current_page' => $orders->currentPage(),
            'last_page' => $orders->lastPage(),
            'next_page_url' => $orders->nextPageUrl(),
            'prev_page_url' => $orders->previousPageUrl(),
            ]
        ]);

        
    }


    // get canceled order
    public function get_canceled_order(Request $request){
        $user = $request->user();
        $orders = Order::whereHas('delivery', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['items', 'user' , 'address'])->where('status' , 'canceled')->paginate(15);

        return  $this->res(true, 'Get canceled  Orders Details!', 200,  [
            'orders'=>OrdersResource::collection($orders) ,    
            'meta' => [
            'total' => $orders->total(),
            'count' => $orders->count(),
            'per_page' => $orders->perPage(),
            'current_page' => $orders->currentPage(),
            'last_page' => $orders->lastPage(),
            'next_page_url' => $orders->nextPageUrl(),
            'prev_page_url' => $orders->previousPageUrl(),
            ]
        ]);

    }


    // get canceled order
    public function get_today_order(Request $request){
        $user = $request->user();
        $orders = Order::whereHas('delivery', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['items', 'user' , 'address'])->whereDate('created_at', Carbon::today())->paginate(15);

        return  $this->res(true, 'Get canceled  Orders Details!', 200,  [
            'orders'=>OrdersResource::collection($orders) ,    
            'meta' => [
            'total' => $orders->total(),
            'count' => $orders->count(),
            'per_page' => $orders->perPage(),
            'current_page' => $orders->currentPage(),
            'last_page' => $orders->lastPage(),
            'next_page_url' => $orders->nextPageUrl(),
            'prev_page_url' => $orders->previousPageUrl(),
            ]
        ]);

    }
    // change status

    public function change_status(Request $request){
        $order = Order::with(['items', 'user' , 'address'])->where('id' , $request->order_id)->whereIn('status', ['on way', 'delivered'])->first();
        if(isset($order)){
            
            $delivery =  DeliveryStatus::where('user_id' , $request->user()->id)->where('order_id' , $request->order_id)->first();
            if(isset($delivery)){

                $order->status =  $request->status;
                $order->save();

        
                return  $this->res(true, 'status Of Order Changed', 200, new OrdersResource($order));
            }


        }

        return  $this->res(false, 'Invalid Data', 404);
       
    }

    public function reset_new_password(Request $request){
        $request->validate([
            'password'=>'required|min:6|string'
        ]);
        $user = User::find($request->user()->id);
        if(isset($user)){
            $user->password = Hash::make($request->password);
            $user->save();
            return  $this->res(true, 'Password has Changed', 200, new UsersResource($user));

        }
    }






}
