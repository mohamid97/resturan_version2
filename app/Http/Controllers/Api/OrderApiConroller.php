<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreOrderRequest;
use App\Http\Resources\Admin\FeesResource;
use App\Http\Resources\Admin\UsersResource;
use App\Http\Resources\Front\OrdersResource;
use App\Models\Admin\Address;
use App\Models\Admin\CitiyPrice;
use App\Models\Admin\Coupon;
use App\Models\Admin\CouponUser;
use App\Models\Admin\OfferCard;
use App\Models\Admin\Offers;
use App\Models\Admin\OrderAddress;
use App\Models\Admin\PointsPrice;
use App\Models\Admin\Product;
use App\Models\Admin\Setting;
use App\Models\Front\Card;
use App\Models\Front\Order;
use App\Models\Front\OrderItem;
use App\Models\User;
use App\Trait\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
class OrderApiConroller extends Controller
{
    protected $user;
    protected $has_coupon;
    protected $cart;
    protected $offer_card;
    protected $total_price;
    protected $order;
    protected $has_pounds;
    protected $coupon;

    use ResponseTrait;
    //
    public function store(StoreOrderRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->user = $request->user();
            $check_order = Order::where('user_id',  $this->user->id)->where('payment_status', 'unpaid')->first();
            if (isset($check_order)) {
                return  $this->res(true, 'You Already Create Order Not Finshed', 404);
            }
            // check if coupon sent 
            $this->has_coupon = null;
            // check coupon
            if(isset($request->coupon_code) && !$this->check_coupon($request)){
                return  $this->res(true, 'Invaild Coupon', 400);
            }
            // get cart and offer cart
            $this->cart = Card::with('items')->where('user_id', $this->user->id)->first();
            $this->offer_card = OfferCard::where('user_id', $this->user->id)->get();
            if(!isset($this->cart) && $this->offer_card->isEmpty()){
                return  $this->res(false, 'Has No Cart Or Error Happend When Trying To Create Order', 404);
            }
            $this->total_price = 0;
            // check if is set card
            if (isset($this->cart) && $this->cart != null) {
                // loop card to get products total price    
                foreach ($this->cart->items as $items) {
                    $product = Product::find($items->product_id);
                    $this->total_price += $product->price * $items->quantity;
                }
            } // end check

            // check if is set card offer
            if (isset($this->offer_card) && $this->offer_card != null) {
                // loop offer card to get products total price    
                foreach ($this->offer_card as $of_cart) {
                    $offer = Offers::find($of_cart->offer_id);
                    if(isset($offer)){
                        $this->total_price += $offer->price;
                    }
                    
                } // end loop of offer card
            } // end check

             $this->has_pounds = null;
            if($request->points){
                $this->get_user_points();
            }
            // start create oreder main data
            $this->order = $this->store_order($request);     
            // store item in orderitem from cart and offer cart
            if ($this->store_cart_to_order_details() && $this->store_offer_cart_to_order_detsils() ) {
                //delete cards
                $this->delete_cards();
                // add order address 
                $this->store_order_address($request);
                DB::commit();
                return  $this->res(true, 'Order Created Successfully! ', 200, ['user' => new UsersResource($this->user), 'orders' => OrdersResource::collection(Order::where('user_id', $this->user->id)->get())]);
            } // end check add order items
            DB::rollBack();
            return  $this->res(false, 'Has No Cart Or Error Happend When Trying To Create Order', 404);
        } catch (ValidationException $e) {
            DB::rollBack();
            // Handle validation exceptions
            return  $this->res(false, 'Validation failed: ',  422,   ['errors' => $e->errors()]);
        } catch (\Exception $e) {
            DB::rollBack();
            return  $this->res(false, $e->getMessage(), $e->getLine(), $e->getMessage());
        }
    } // end store function 

    // get user points 
    private function get_user_points(){
        $user = User::find($this->user->id);
        $this->has_pounds = $user->points_pound;
        return $this->has_pounds;
    }

    // check coupon 
    public function check_coupon($request){
        if ($request->coupon_code) {    
            // Get the current date and time
            $currentDate = Carbon::now('Africa/Cairo');
            $this->coupon = Coupon::where('code', $request->coupon_code)->first();
            
            if (!isset( $this->coupon)) {
                return  false;
            }
            $coupon_user = CouponUser::where('coupon_id',  $this->coupon->id)->where('user_id', $this->user->id)->first();
            
            // Parse the start_date and end_date using Carbon
            $startDate = Carbon::parse( $this->coupon->start_date);
            $endDate = Carbon::parse($this->coupon->end_date);
            if (isset($coupon_user) || !$currentDate->between($startDate, $endDate)) {
               return false;
            }
            
            $this->has_coupon = (int)   $this->coupon->percentage;

            return $this->has_coupon;
            
        }
    }

    // start order
    private function store_order($request){
        $old_price = null;
        $total_price  = $this->total_price;  
        
        // check for coupon
        if(isset($this->has_coupon) && $this->has_coupon != null){
            $old_price = $total_price;
            $total_price = ( $total_price*  $this->has_coupon ) / 100 ; 
            $total_price  = $total_price - $total_price;
        }

        // check for pounds
        if(isset($this->has_pounds) && $this->has_pounds != null){
            $old_price = $total_price;
            $total_price = ( $total_price -  $this->has_pounds); 

        }

        $order = new  Order();
        $order->user_id = $this->user->id;
        $order->old_price = $old_price;
        $order->total_price = $total_price; 
        $order->shipping_city_id = $request->city_id;
        $order->status = 'pending';
        $order->save();
        
        if(isset($this->has_coupon) && $this->has_coupon != null){
            $this->add_user_coupon();
        }

        if(isset($this->has_pounds) && $this->has_pounds != null){
            $this->reset_points_pounds();

            
        }
        return $order;
    }

    //reset pounds and points
    private function reset_points_pounds(){
        $user = User::find($this->user->id);
        $user->points = 0;
        $user->points_pound = 0;
        $user->save();
    }

    // add coupon to user 
    private function add_user_coupon(){
        
        $coupon_user = new CouponUser();
        $coupon_user->coupon_id =  $this->coupon->id;
        $coupon_user->user_id   = $this->user->id;
        $coupon_user->save();

        
    }


    // store order address
    private function store_order_address($request){
        $order_address = new OrderAddress();
        $order_address->order_id =  $this->order->id;
        $order_address->first_name = $request->first_name;
        $order_address->last_name  = $request->last_name;
        $order_address->gov_id      = $request->gov_id;
        $order_address->city_id     = $request->city_id;
        $order_address->address      = $request->address;
        $order_address->phone      = $request->phone;
        $order_address->save();
    }

    private function delete_cards(){
        if(isset($this->cart)){
            $this->cart->delete();
        } 
        foreach ($this->offer_card as $of_card) {
            $of_card->delete();
        }
    }
    // store card at order details 

    public function store_cart_to_order_details()
    {
        if(isset($this->cart) && isset($this->cart->items)){
            // loop card to get products total price    
            foreach ($this->cart->items as $items) {
                $product = Product::find($items->product_id);
                if (isset($product)) {
                    // add order details data
                    $order_details = new OrderItem();
                    $order_details->order_id = $this->order->id;
                    $order_details->product_id = $items->product_id;
                    $order_details->quantity =   $items->quantity;
                    $order_details->price    =  $product->price * $items->quantity;
                    $order_details->type     = 'normal';
                    $order_details->save();
                }
            }
        }

        return true;
    } // end store cart at order details

    // store offer cart to order details 
    public function store_offer_cart_to_order_detsils()
    {
        if(isset($this->offer_card)){
                foreach ($this->offer_card as $of_cart) {
                    $offer = Offers::find($of_cart->offer_id);
                    if(isset($offer)){
                        $order_details = new OrderItem();
                        $order_details->order_id = $this->order->id;
                        $order_details->quantity = 0;
                        $order_details->price    =    $offer->price;
                        $order_details->type     = 'offer';
                        $order_details->offer_id = $offer->id;
                        $order_details->save();
                    }

                }
        }

        return true;
    } // end store offer cart to order details 


    // get orders of sepecial users
    public function get(Request $request)
    {
        $this->user = $request->user();
        $orders = Order::with(['items', 'user' , 'address'])->where('user_id',  $this->user->id)->paginate(15);
        return  $this->res(true, 'Get Order Details!', 200, [
          
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

    //get fees
    public function fees(Request $request)
    {
        $price = CitiyPrice::with(['city', 'gov'])->where('citiy_id', $request->city_id)->first();

        if (isset($price)) {
            return  $this->res(true, 'City Price', 200, new FeesResource($price));
        }

        return  $this->res(true, 'Has No Price', 404);
    }


    //store guest order 
    public function store_order_guest(Request $request){    
        try{
            // Define validation rules
            $rules = [
                'address' => 'required|array',
                'address.gov_id' => 'required|integer',
                'address.city_id' => 'required|integer',
                'address.address' => 'required|string',
                'phone_number' => 'required|integer',
                'first_name'   =>'required|string:max:200',
                'last_name'   =>'required|string:max:200',
                'products' => 'nullable|array',
                'products.*.id' => 'required|integer|exists:products,id',
                'products.*.quantity' => 'required|integer|min:1',
                'offers' => 'nullable|array',
                'offers.*.id' => 'nullable|integer|exists:offers,id',
                'points'=>'nullable|in:0,1'
            ];

            // Define custom error messages
            $messages = [
                'address.required' => 'Address is required.',
                'address.array' => 'Address must be an array.',
                'address.gov_id.required' => 'Governorate ID is required.',
                'address.gov_id.integer' => 'Governorate ID must be an integer.',
                'address.city_id.required' => 'City ID is required.',
                'address.city_id.integer' => 'City ID must be an integer.',
                'address.address.required' => 'Address field is required.',
                'address.address.string' => 'Address must be a string.',
                'phone_number.required' => 'Phone number is required.',
                'phone_number.integer' => 'Phone number must be an integer.',
                'first_name.required'  => 'First Name Required',    
                'last_name.required'  => 'Last Name Required',    
                'products.array' => 'Products must be an array.',
                'products.*.id.required' => 'Product ID is required for each product.',
                'products.*.id.integer' => 'Product ID must be an integer.',
                'products.*.id.exists' => 'Product ID must exist in the products table.',
                'products.*.quantity.required' => 'Quantity is required for each product.',
                'products.*.quantity.integer' => 'Quantity must be an integer.',
                'products.*.quantity.min' => 'Quantity must be at least 1.',
                'offers.array' => 'Offers must be an array.',
                'offers.*.id.integer' => 'Offer ID must be an integer.',
                'offers.*.id.exists' => 'Offer ID must exist in the offers table.',
            ];

     
                // Create validator instance
             $validator = Validator::make($request->all(), $rules, $messages);
            DB::beginTransaction();

            $ship_price = CitiyPrice::where('citiy_id' , $request->address['city_id'])->first();
            if(!isset($ship_price)){
                return  $this->res(false, 'No price For shipment', 404);
            }
           
            //get total price
            $total = 0;
            foreach($request->products as $pro){
                
              $product = Product::where('id' , $pro['id'])->first();
              if(isset($product)){
                $total += $product->price;
              }
            }
            
            $order = new Order();
            $order->user_id = null;
            $order->total_price = $total;
            $order->shipping_city_id =  ($ship_price && $ship_price->citiy_id) ? $ship_price->citiy_id : 0;
            $order->status = 'pending';
            $order->save();

            // loop all products normal item
            foreach($request->products as $pro){
                $product = Product::where('id' , $pro['id'])->first();

                if(isset($product)){

                    // start addin order item 
                    $order_item = new OrderItem();
                    $order_item->order_id    = $order->id;
                    $order_item->product_id  = $pro['id'];
                    $order_item->quantity    =  $pro['quantity'];
                    $order_item->price       = $product->price * $pro['quantity'];
                    $order_item->type = 'normal';
                    $order_item->save();

                }

            }

            // start offer 

            foreach ($request->offers as $of_cart) {
                $offer = Offers::find($of_cart['id']);
                if(isset($offer)){
                    $order_details = new OrderItem();
                    $order_details->order_id = $order->id;
                    $order_details->quantity = 0;
                    $order_details->price    =    $offer->price;
                    $order_details->type     = 'offer';
                    $order_details->offer_id = $offer->id;
                    $order_details->save();
                }
    
            }




            // start order address
            $order_address = new OrderAddress();
            $order_address->order_id = $order->id;
            $order_address->gov_id   = $ship_price->governorate_id;
            $order_address->city_id  = $ship_price->citiy_id;
            $order_address->first_name  = $request->first_name;
            $order_address->last_name  = $request->last_name;
            $order_address->address  = $request->address['address'];
            $order_address->phone     = $request->phone_number;
            $order_address->save();


            DB::commit();

            $order = Order::with(['items' , 'address'])->where('id' , $order->id)->get();
       
            return  $this->res(true, 'Order Created Successfully! ', 200, ['user' => $request->phone_number, 'orders' => OrdersResource::collection($order)]);



        }catch (ValidationException $e) {
            DB::rollBack();
            // Handle validation exceptions
            return  $this->res(false, 'Validation failed: ',  422,   ['errors' => $e->errors()]);
        } catch(\Exception $e){
            DB::rollBack();
            return  $this->res(false, $e->getMessage(), $e->getLine(), $e->getMessage());
        }






    } // end user store as guest



}
