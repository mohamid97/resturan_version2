<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Features;
use App\Models\Admin\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
class FeaturedController extends Controller
{
    // get all futured 
    public function index(){
        $products = Product::with('gallery')->get();
        $featured = Features::with('product')->get();
        return view('admin.products.featured' , ['features'=>$featured , 'products'=>$products]);

    }

    // delete featured
    public function delete($id){
       $featured = Features::findOrFail($id);
       $featured->delete();
       Alert::success('Success', 'Featured Product Delete Succesfully !');
       return redirect()->route('admin.featured.index');
    }


    // store new product to feature 
    public function store(Request $request){
        $request->validate([
            'product_id'=>'required|numeric|gt:0|exists:products,id',
        ]);

        $featured = Features::where('product_id' , $request->product_id)->first();
        if(isset($featured)){
            Alert::error('error', 'Aleady added in features before !');
            return redirect()->route('admin.featured.index');
        }
        $featured = new  Features();
        $featured->product_id = $request->product_id;
        $featured->save();
        Alert::success('Success', 'Featured Product Added Succesfully !');
        return redirect()->route('admin.featured.index');
    }
}
