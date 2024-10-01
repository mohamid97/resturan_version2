<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreCartRequest;
use App\Http\Requests\Api\StoreOfferCardRequets;
use App\Http\Requests\Api\UpdateCartRequest;
use App\Http\Resources\Admin\CartWithOptionResource;
use App\Http\Resources\Admin\OfferCardResource;
use App\Http\Resources\Admin\OffersCardResource;
use App\Http\Resources\Admin\UsersResource;
use App\Http\Resources\Front\CartResource;
use App\Models\Admin\CartItemsExtras;
use App\Models\Admin\CartItemsTypes;
use App\Models\Admin\OfferCard;
use App\Models\Admin\Offers;
use App\Models\Admin\Product;
use App\Models\Admin\Typeoption;
use App\Models\Front\Card;
use App\Models\Front\CardItem;
use App\Models\User;
use App\Trait\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    use ResponseTrait;

    protected $user;
    protected $cart;
    protected $product;
    protected $cartItem;
    protected $offer;
    protected $offer_card;
    protected $cardTypes;
    protected $request;
    protected $card_item_type;
    protected $card_item_extra;


    // store cart
    public function store(StoreCartRequest $request){
       
        try{  
           
            // transaction
            DB::beginTransaction(); 
            $this->request = $request; 
      
            // get user data from request 
            $this->user = $request->user(); 
            $this->product = Product::with(['category' , 'types' , 'extras' , 'combos'])->find($this->request->product_id);
 
            if(!isset($this->product)){
                return  $this->res(true ,'Proudct Not Found' , 404);
            }

            if(isset($this->product->category)){
                if($this->product->category->has_options != '1'){
                    $this->storeNoOptionsProduct($request); 
                    $carts = Card::with('items.product')->where($this->user->user_id)->get();
                    DB::commit();
                    return  $this->res(true ,'Added To Cart ' , 200 , CartWithOptionResource::collection($carts));
                }

                if(!$this->storeOptionsProduct()){
                    return  $this->res(false ,'Invalid data sent' , 402);
                } 

                DB::commit();
                $carts = Card::with('items.product')->where($this->user->user_id)->get();
               return  $this->res(true ,'Added To Cart ' , 200 , CartWithOptionResource::collection($carts));
              

            }else{
                return  $this->res(true ,'Product Not Belong To Category ' , 404);
            }

                 
        }catch(\Exception $e){
            DB::rollBack();
            return  $this->res(false ,$e->getMessage() , $e->getLine());
        }



    } // end function add cart

    // store prodduct that has option 
    public function storeNoOptionsProduct(){
        // if has already cart
        if(!$this->check_user_has_cart()){
            $this->create_new_cart();
        }
        $this->checkItemProduct();
        return true;
    }

        //  check if product in cart item 
        public function checkItemProduct(){
            $this->cartItem = CardItem::where('card_id' , $this->cart->id)->where('product_id' , $this->product->id)->first();
            if(isset($this->cartItem ) && $this->cartItem  != null){ 
                $this->cartItem->quantity    = $this->cartItem->quantity  + 1;
                $this->cartItem->save();                 
            }   

            $this->storeCartItem();
           
        }
    // add cart item 
    public function storeCartItem(){

        $this->cartItem = new CardItem();
        $this->cartItem->card_id = $this->cart->id;
        $this->cartItem->product_id = $this->product->id;
        $this->cartItem->quantity   = 1;
        if($this->product->category->has_options == '1'){
            $this->cartItem->has_options = '1';
            $this->cartItem->combo_id = $this->request->combo_id;

        }
        $this->cartItem->save();
    }



    // store normal product to cart
    protected function storeOptionsProduct(){
        $this->create_new_cart();
        $this->storeCartItem();
        if(!$this->create_item_types()){
            return false;
        }
        if(!$this->create_item_extra()){
            return false;
        }


        return true;





    }



    // check if the user
    protected function check_user_has_cart(){

        // check if user has already cart before or not and get product object from id  
        $this->cart = Card::where('user_id' , $this->user->id)->first();  
        if(isset($this->cart)){
            return true;
        }
        return false;
    }

    // create new cart 
    private function create_new_cart(){
        $this->cart = new Card();
        $this->cart->user_id = $this->user->id;
        $this->cart->save();
    }

    // store item types 
    private function create_item_types(){
      
        if($this->request->has('types')){
            // Extract type_ids from the request
            $typeIdsFromRequest = array_column($this->request->input('types'), 'type_id');   
              
            foreach ($this->product->types as $productType) {
                // Check if the current product type_id is in the type_ids from the request
                if (in_array($productType->id, $typeIdsFromRequest)) {
                    foreach ($this->request->input('types') as $typeData) {
                        if ($productType->id == $typeData['type_id']) {
                            
                            $option = Typeoption::where('type_id' , $typeData['type_id'])->where('id' , $typeData['option_id'])->first();
                            
                            if(isset($option)){
                                $this->card_item_type = new CartItemsTypes();
                                $this->card_item_type->card_item_id  = $this->cartItem->id;
                                $this->card_item_type->type_id       = $typeData['type_id'];
                                $this->card_item_type->typeoption_id = $option->id;
                                $this->card_item_type->save();

                            }else{ // if has no option
                                return false;
                            }

                        }
                    } // end loop for all types sent in request 

                }else{ // if prodsuct types didnot exist in data in request
                    return false;
                } 
            }
            
            return true;
        }

        return false;

       
        
    }




    // store extra 
    private function create_item_extra() {
        foreach ($this->product->extras as $extra) {
        
            if(in_array($extra->id , $this->request->extras_ids)){
               $this->card_item_extra = new CartItemsExtras();
               $this->card_item_extra->card_item_id = $this->cartItem->id;
               $this->card_item_extra->extra_id = $extra->id;
               $this->card_item_extra->save();

            }else{
                return false;
            }

        }

        return true;

    } // end store extra item


    // private function validate_options_products_data(){

    //     if ($this->request->has('extras')) {}
        
    // }






    // create new cart 
    // private function createNewCart(){
        
    //     $cart = new Card();
    //     $cart->user_id = $this->user->id;
    //     $cart->save();
    //     $this->cart = $cart;
    // }















    // update cart
    public function update(UpdateCartRequest $request){
        try{
            // begin transction
            DB::beginTransaction();
                $this->user = $request->user();  
                $this->cart = Card::where('user_id' , $this->user->id)->first();   
                $this->cartItem = CardItem::where('card_id' , $this->cart->id)->where('product_id' , $request->product_id)->first();
                $this->product = Product::findOrFail($request->product_id);
            if(isset($this->cart) && isset($this->cartItem)){
                if($request->type == 'increase'){
                    $this->cartItem->quantity     = $this->cartItem->quantity + 1;
                    $this->cartItem->total_price  =  $this->cartItem->total_price +  $this->product->price;
                    $this->cartItem->save();
                    DB::commit();
                    return  $this->res(true ,'Cart Updated Succeffuly !' , 200 , new CartResource($this->cart));

                }elseif($request->type == 'decrease'){
                    
                    if($this->cartItem->quantity >= 1){
                    
                        $this->cartItem->quantity     = $this->cartItem->quantity - 1;
                        $this->cartItem->total_price  =  $this->cartItem->total_price -  $this->product->price;
                        $this->cartItem->save();
                        if($this->cartItem->quantity <= 0){
                            $this->cartItem->delete();
                        }
                        DB::commit();
                        return  $this->res(true ,'Cart Updated Succeffuly !' , 200 , new CartResource($this->cart));
                    }
                
                    return  $this->res(true ,'This item can not decrease' , 401);
                }elseif(isset($request->quantity) && $request->quantity > 0){
                    $this->cartItem->quantity     = $request->quantity;
                    $this->cartItem->total_price  =  $request->quantity *  $this->product->price;
                    $this->cartItem->save();
                    DB::commit();
                    return  $this->res(true ,'Cart Updated Succeffuly !' , 200 , new CartResource($this->cart));

                }
                return  $this->res(false ,'Invalid Data' , 404);
            }
            return  $this->res(true ,'Has Not Cart' , 404);
           

        }catch(\Exception $e){
            DB::rollBack();
            return  $this->res(false ,'Error Happend' , $e->getCode() , $e->getMessage());
        }

    } // end update cart


    // deelte cart 
    public function delete(Request $request){
        try{ 
            DB::beginTransaction();
            $this->user = $request->user();
            $this->cart = Card::where('user_id' , $this->user->id)->first();
            if(isset($this->cart)){
                $this->cart->delete();
                DB::commit();
                return  $this->res(true ,'Cart Deleted Succeffuly !' , 200);
            }
            return  $this->res(true ,'Has No Card !' , 404); 
          }catch(\Exception $e){
            DB::rollBack();
            return  $this->res(false ,'Error Happend' , $e->getCode() , $e->getMessage());
          }

    }


    public function delete_item(StoreCartRequest $request){
        try{ 
            DB::beginTransaction();
            $this->user = $request->user();
            $this->cart = Card::where('user_id' , $this->user->id)->first();
            $this->cartItem = CardItem::where('card_id' , $this->cart->id)->where('product_id' , $request->product_id)->first();
            if(isset($this->cart) && isset($this->cartItem)){
                $this->cartItem->delete();
                $check_have_item = CardItem::where('card_id' , $this->cart->id)->first();
                if(!isset($check_have_item )){
                    $this->cart->delete();
                }
                DB::commit();
            }
            return  $this->res(true ,'Cart Item Deleted Succeffuly !' , 200);     

          }catch(\Exception $e){
            DB::rollBack();
            return  $this->res(false ,'Error Happend' , $e->getCode() , $e->getMessage());
        }
    } // end function delete item 





    // get cart with token of special user
    public function get(Request $request) {
        try{
            $this->user = $request->user();
            // get cart of the user
            $this->cart = Card::with('items')->where('user_id' , $this->user->id)->first(); 
            if(isset($this->cart)){
                return  $this->res(true ,'Added To Cart ' , 200 , new CartResource($this->cart));
            }
            return  $this->res(true ,'No Or Empty Card For User' , 200);
        }catch(\Exception $e){
            return  $this->res(false ,'Error Happend' , $e->getCode() , $e->getMessage());
        }
    } // end get function 


    // add offer to cart offer 
    public function add_card_offer(StoreOfferCardRequets $request){
      
        try{
            $this->user = $request->user();
            $this->offer = Offers::where('id' , $request->offer_id)->first();            
            if(!isset($this->offer)){
                return  $this->res(true ,'No Offer Found' , 404);
            }
            DB::beginTransaction();
            $this->offer_card = OfferCard::where('user_id' , $this->user->id)->where('offer_id' , $request->offer_id)->first();
            if(isset($this->offer_card) && $this->offer_card != null){
                return  $this->res(true ,'Already Take The Offer');
            }
            // store cart offer
            $this->storeCartOffer($request->offer_id);
            DB::commit();
            $offer_cards = OfferCard::with('offer.offer_products')->where('user_id' , $this->user->id)->get();
            return  $this->res(true ,'Offer Added Successfully !' , 200 , ['user' => new UsersResource(User::find($this->user->id)) , 'offers_card'=>OffersCardResource::collection($offer_cards) ] );
      
        }catch(\Exception $e){
            DB::rollBack();
            return  $this->res(false ,'Error Happend' , $e->getCode() , $e->getMessage());
        }


    } // end add offer to cart

    // store new cart offer 
    private function storeCartOffer($offer_id){
        $offer_card = new OfferCard();
        $offer_card->user_id = $this->user->id;
        $offer_card->offer_id = $offer_id;
        $offer_card->save();
    }

    // delete offer cart

    public function offer_cart_delete(StoreOfferCardRequets $request){
        try{
            $this->user = $request->user();
            $this->offer = Offers::where('id' , $request->offer_id)->first();
            if(!isset($this->offer)){
                return  $this->res(true ,'Offer Not Found !' , 404);

            }
            DB::beginTransaction();
            $this->offer_card = OfferCard::where('user_id' , $this->user->id)->where('offer_id' , $request->offer_id)->first();
            if(isset( $this->offer_card) &&  $this->offer_card != null){
            $this->offer_card->delete();
               DB::commit();
               return  $this->res(true ,'Offer Deleted Successfully !' , 200);

            }
            return  $this->res(false ,'No Offer To Deleted' , 404);
        
        }catch(\Exception $e){

            DB::rollBack();
            return  $this->res(false ,'Error Happend' , $e->getCode() , $e->getMessage());

        }


    }


    // get offer cart 

    public function offer_cart_get(Request $request)
    {
       
        try{
            $this->user = $request->user();
            $this->offer_card = OfferCard::with('offer.offer_products')->where('user_id' , $this->user->id)->get();     
             if(!$this->offer_card->isEmpty()){  
                return  $this->res(true ,'Offer Carts ' , 200 ,  OffersCardResource::collection($this->offer_card));
             }
            return  $this->res(true ,'User Has No Offer In Cart' , 200);
            

        }catch(\Exception $e){    
            return  $this->res(false ,'Error Happend' , $e->getCode() , $e->getMessage());
        }


    } // end get cart offer 




}
