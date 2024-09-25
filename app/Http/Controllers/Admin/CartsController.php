<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Front\Card;
use App\Trait\ResponseTrait;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartsController extends Controller
{
  use ResponseTrait;
    // get all cards for admin 
    public function get(){
       $carts = Card::with(['user' , 'items'])->paginate(10);
       return view('admin.carts.index' , ['carts' => $carts]);

    }

    // delete carts 

    public function delete($id){
        try{ 
            DB::beginTransaction();
            $cart = Card::findOrFail($id);
            if(isset($cart)){
                $cart->delete();
                DB::commit();
            }
            return redirect()->route('admin.cards.index');

          }catch(\Exception $e){
            DB::rollBack();
            return redirect()->route('admin.cards.index');
          }
    } // end delete cart


    // show cart with deyails 
    public function show_details($id){
        try{ 
            $cart = Card::with(['user'  , 'items.product.translations' => function ($query) {
              $query->where('locale', app()->getLocale());
          } , 'items.product.gallery'])->findOrFail($id);


          $totalPrice = $cart->items->sum(function ($item) {
            return $item->quantity *  $item->product->price;
          });


          $totla_quantity = $cart->items->sum(function ($item) {
            return $item->quantity;
          });


            return view('admin.carts.show_details' , ['cart' => $cart  , 'total_price'=> $totalPrice , 'totla_quantity'=>$totla_quantity]);
          }catch(\Exception $e){
            return  $this->res(false ,'Error Happend' , $e->getCode() , $e->getMessage());
          }
    }






}
