<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Lang;
use App\Models\Admin\Offers;
use App\Models\Admin\Product;
use App\Models\OffersProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class OffersController extends Controller
{
    public $langs;
    public function __construct()
    {
        $this->langs = Lang::all();    
    }

    // index 
    public function index(){
        $offers = Offers::withTrashed()->get();
        return view('admin.offers.index' , ['langs' => $this->langs , 'offers'=>$offers]);
    }
    //add
    public function add() {
        $products = Product::all();
        return view('admin.offers.add' , ['langs'=>$this->langs , 'products'=>$products]);

    } 

    // store offers 

    public function store(Request $request){


        $request->validate([
            'title.*'=>'required|string',
            'des.*'=>'required|string',
            'small_des.*'=>'required|string',
            'products.*'=>'required|integer',
            'price'=>'required|integer',
            'old_price'=>'required|integer',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);


        
        try{
        
            DB::beginTransaction();
            if($request->has('image')){
                $image_name = $request->image->getClientOriginalName();
                $request->image->move(public_path('uploads/images/offers'), $image_name);
            }

            $offer = Offers::create([
                'old_price'=>$request->old_price,
                'price'=>$request->price,
                'image'=>$image_name,   
            ]);


            foreach ($this->langs as $lang) {
                $offer->{'title:'.$lang->code}       = $request->title[$lang->code];
                $offer->{'des:'.$lang->code}         = $request->des[$lang->code];
                $offer->{'small_des:'.$lang->code}   = $request->small_des[$lang->code];
            }
            $offer->save();

            foreach($request->products as $pro){
               $offer_products = new OffersProducts();
               $offer_products->offers_id = $offer->id;
               $offer_products->product_id = $pro;
               $offer_products->save();

            }

            DB::commit();
            Alert::success('Success', 'Stored Successfully ! !');
            return redirect()->route('admin.offers.index');

        }catch(\Exception $e){
            dd($e->getLine() , $e->getMessage());
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.offers.index');
        }
    } // end store offers



    // edit function 
    public function edit($id){
        $offer  = Offers::where('id' , $id)->first();
        return view('admin.offers.edit' , ['offer'=>$offer , 'langs'=>$this->langs]);
    }


    // update function 
    public function update(Request $request , $id){
        $request->validate([
            'title.*'=>'required|string',
            'des.*'=>'required|string',
            'small_des.*'=>'required|string',
            'price'=>'required|integer',
            'old_price'=>'required|integer',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);


        try{
        
            DB::beginTransaction();
            $offer = Offers::findOrFail($id);
            if($request->has('image')){
                $image_name = $request->image->getClientOriginalName();
                $request->image->move(public_path('uploads/images/offers'), $image_name);
                if (isset($offer->image) && file_exists(public_path('uploads/images/offers/' .$offer->image))) {
                    unlink(public_path('uploads/images/offers/' .$offer->photo));
                }
                $offer->image = $image_name;
            }

            $offer->old_price = $request->old_price;
            $offer->price     = $request->price;
            foreach ($this->langs as $lang) {
                $offer->{'title:'.$lang->code}       = $request->title[$lang->code];
                $offer->{'des:'.$lang->code}         = $request->des[$lang->code];
                $offer->{'small_des:'.$lang->code}   = $request->small_des[$lang->code];
            }
            $offer->save();


            DB::commit();
            Alert::success('Success', 'Updated Successfully !');
            return redirect()->route('admin.offers.index');

        }catch(\Exception $e){
           // dd($e->getLine() , $e->getMessage());
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.offers.index');
        }





    }




    public function destroy($id)
    {
        $offer = Offers::findOrFail($id);
        $offer->forceDelete();
        Alert::success('success', 'Offer Deleted Successfully !');
        return redirect()->route('admin.offers.index');
    }

    public function soft_delete($id)
    {
        $offer = Offers::findOrFail($id);
        $offer->delete();
        Alert::success('success', 'Offer Soft Deleted Successfully !');
        return redirect()->route('admin.offers.index');

    }

    public function restore($id)
    {
        $offer = Offers::withTrashed()->findOrFail($id);
        $offer->restore();
        Alert::success('success', 'Offer Restored Successfully !');
        return redirect()->route('admin.offers.index');

    }


    // show product inside offer 

    public function show_products($id){
        $offer = Offers::with('offer_products')->where('id' , $id)->first();
        $products = Product::all();
        return view('admin.offers.offer_product' , ['offer' => $offer , 'products' => $products]);
        
    }

    // add product to offer 

    public function add_product_offer(Request $request , $id){
        $request->validate([
            'product'=>'required|integer',      
        ]);
        try{
            DB::beginTransaction();
            $offer = Offers::findOrFail($id);
            $offer_product = OffersProducts::where('offers_id' , $id)->where('product_id',$request->product)->first();
            if(!isset($offer_product)){      
               $offer_product = new OffersProducts();
                $offer_product->offers_id = $id;
                $offer_product->product_id = $request->product;
                $offer_product->save();
                DB::commit();
                Alert::success('Success', 'Product Added Successfully !');
                return redirect()->route('admin.offers.index');
            }
            
            Alert::error('error', 'Already in Offers');
            return redirect()->route('admin.offers.index');

           
        }catch(\Exception $e){
            dd($e->getMessage() , $e->getLine());
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.offers.index');
        }
        
    }

    // delete product from offer 
     
    public function delete_product_offer($offer_id , $product_id){
        $offer = Offers::findOrFail($offer_id);
        $offer_product = OffersProducts::where('offers_id' , $offer_id)->where('product_id',$product_id)->first();
        if(isset($offer_product) && $offer_product !== null){
            $offer_product->delete();
            Alert::success('success', 'Product Deleted  Successfully !');
            return redirect()->route('admin.offers.index');
        }

        Alert::error('error', 'Tell The Programmer To solve Error');
        return redirect()->route('admin.offers.index');

    }





}
