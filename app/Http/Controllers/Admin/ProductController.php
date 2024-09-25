<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductComboRequest;
use App\Http\Requests\Admin\StoreProductExtraRequest;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\storeTypeProductRequest;
use App\Models\Admin\Category;
use App\Models\Admin\Combo;
use App\Models\Admin\Extra;
use App\Models\Admin\Gallary;
use App\Models\Admin\Lang;
use App\Models\Admin\Product;
use App\Models\Admin\ProductComobs;
use App\Models\Admin\ProductExtra;
use App\Models\Admin\ProductsTypes;
use App\Models\Admin\Types;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    protected $langs;
    public function __construct()
    {
        $this->langs = Lang::all();
    }

    //
    public function index()
    {
        return view('admin.products.index' , ['langs'=>$this->langs , 'products'=> Product::with('category')->get() , 'categories'=> Category::all()]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.add' , ['categories' => $categories , 'langs'=> $this->langs]);

    }

    public function store(StoreProductRequest $request)
    {

        try{
            DB::beginTransaction();
              $product =  new Product();
              $product->category_id = ($request->category != '0' ) ? $request->category : null;
              $product->price = $request->price;
              $product->star = $request->star;
              $product->discount = $request->discount;
              $product->old_price = $request->old_price;
            foreach ($this->langs as $lang) {
                $product->{'name:'.$lang->code}  = $request->name[$lang->code];
                $product->{'des:'.$lang->code}  = $request->des[$lang->code];
                $product->{'meta_des:'.$lang->code}  = $request->meta_des[$lang->code];
                $product->{'meta_title:'.$lang->code}  = $request->meta_title[$lang->code];
                $product->{'slug:'.$lang->code}  = $request->slug[$lang->code];
            }
            $product->save();
            DB::commit();
            Alert::success('Success', 'Product Added Successfully !');
            return redirect()->route('admin.products.index');
        }catch(\Exception $e){
            dd($e->getLine() , $e->getMessage());
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.products.index');

        }


    }

    public function update(StoreProductRequest $request , $id)
    {
        try {
            DB::beginTransaction();
            $product = Product::findOrFail($id);
            $product->update([
                'price'       => $request->price,
                'discount'    => $request->discount,
                'old_price'   =>$request->old_price,  
                'category_id' => $request->category,
                'star'       => $request->star
            ]);
            foreach ($this->langs as $lang) {
                $product->{'name:'.$lang->code}  = $request->name[$lang->code];
                $product->{'des:'.$lang->code}  = $request->des[$lang->code];
                $product->{'meta_des:'.$lang->code}  = $request->meta_des[$lang->code];
                $product->{'meta_title:'.$lang->code}  = $request->meta_title[$lang->code];
                $product->{'slug:'.$lang->code}  = $request->slug[$lang->code];
            }

            $product->save();
            DB::commit();
            Alert::success('Success', 'Product Updated Successfully !');
            return redirect()->route('admin.products.index');
        }catch (\Exception $e){
            dd($e->getLine() , $e->getMessage());
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.products.index');
        }

    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.update' , ['langs'=>$this->langs , 'categories'=> $categories , 'product'=>$product]);

    }

    public function gallery($id){
        $product = Product::with('gallery')->findOrFail($id);
        return view('admin.products.Gallary' , ['product'=>$product]);
    }

    public function store_gallery(Request $request , $id){

        $product = Product::findOrFail($id);
        $request->validate([
            'photo'=>'nullable|image|mimes:jpeg,png,jpg,gif,webp'
        ]);

        if($request->has('photo')){
            $image_name = $request->photo->getClientOriginalName();
            $request->photo->move(public_path('uploads/images/gallery'), $image_name);
            $gallery = new Gallary();
            $gallery->product_id = $product->id;
            $gallery->photo = $image_name;
            $gallery->save();
            Alert::success('Success', 'Product Gallery Added Successfully !');
            return redirect()->route('admin.products.index');
        }
        Alert::error('error', 'Tell The Programmer To solve Error');
        return redirect()->route('admin.products.index');


    }

    public function delete_gallery($id){

        try {
            DB::beginTransaction();
            $gallery = Gallary::findOrFail($id);
            if (isset($gallery->photo) &&file_exists(public_path('uploads/images/gallery/' .$gallery->photo))) {
                unlink(public_path('uploads/images/gallery/' .$gallery->photo));
            }
            $gallery->delete();
            DB::commit();
            Alert::success('Success', 'Product Gallery Added Successfully !');
            return redirect()->route('admin.products.index');
        }catch (\Exception $e){
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.products.index');
        }

    }



    // start type at products 
    public function add_type($id)
    {
        return view('admin.products.add_type', [
            'types' => Types::whereHas('options', function ($query) {
                $query->where('default', '1');
            })->whereDoesntHave('products', function ($query) use ($id) {
                $query->where('products_types.product_id', $id)
                      ->whereColumn('products_types.type_id', 'types.id');
            })->get(),
            'product_id' => $id,
            'product_types' => Types::whereHas('products', function ($query) use ($id) {
                $query->where('products.id', $id);
            })->get(),
        ]);
    }
    

    // store the type value 
    public function store_type(storeTypeProductRequest $request){
        
        try{

            $product_type = ProductsTypes::where('product_id' , $request->product_id)->where('type_id' , $request->type_id)->first();
            if(isset($product_type)){
                Alert::error('error', 'This Type Added Before');
                return redirect()->route('admin.products.index');
            }
            DB::beginTransaction();
            $product_type = new ProductsTypes();
            $product_type->type_id = $request->type_id;
            $product_type->product_id = $request->product_id;
            $product_type->save();
            DB::commit();
            Alert::success('Success', 'Type Added To Product Successfully !');
            return redirect()->route('admin.products.index');
        }catch(\Exception $e){
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.products.index');

        }

    } // end store type at product 

    //remove type from product

    public function destroy_type($product_id , $type_id){
        $product_type = ProductsTypes::where('product_id' , $product_id)->where('type_id' , $type_id)->first();
        if(isset($product_type)){
            $product_type->delete();
            Alert::success('Success', 'Type Removed From Product Successfully !');
            return redirect()->back();
        }

        Alert::error('error', 'Tell The Programmer To solve Error');
        return redirect()->back();

    }


    // ============================ start extra =====================================
    // create extra
    public function add_extra($id){
        return view('admin.products.add_extra', [
            'extras' => Extra::whereDoesntHave('products', function ($query) use ($id) {
                $query->where('product_extras.product_id', $id)
                      ->whereColumn('product_extras.extra_id', 'extras.id');
            })->get(),
            'product_id' => $id,
            'product_extras' => Extra::whereHas('products', function ($query) use ($id) {
                $query->where('products.id', $id);
            })->get(),
        ]);
    }



    //store new extra 
    public function store_extra(StoreProductExtraRequest $request){
        try{

            $product_extra = ProductExtra::where('product_id' , $request->product_id)->where('extra_id' , $request->extra_id)->first();
            if(isset($product_extra)){
                Alert::error('error', 'This Extra Added Before');
                return redirect()->back();
            }
            DB::beginTransaction();
            $product_type = new ProductExtra();
            $product_type->extra_id = $request->extra_id;
            $product_type->product_id = $request->product_id;
            $product_type->save();
            DB::commit();
            Alert::success('Success', 'Extra Added To Product Successfully !');
            return redirect()->back();
        }catch(\Exception $e){
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.products.index');

        }
    }

    // delete extra from product
    public function destroy_extra($product_id , $extra_id){
        $product_extra = ProductExtra::where('product_id' , $product_id)->where('extra_id' , $extra_id)->first();
        if(isset($product_extra)){
            $product_extra->delete();
            Alert::success('Success', 'Extra Removed From Product Successfully !');
            return redirect()->back();
        }

        Alert::error('error', 'Tell The Programmer To solve Error');
        return redirect()->back();

    }



      // ============================ start comob =====================================
    // create extra
    public function add_combo($id){
        return view('admin.products.add_combo', [
            'combos' => Combo::whereDoesntHave('products', function ($query) use ($id) {
                $query->where('product_comobs.product_id', $id)
                      ->whereColumn('product_comobs.combo_id', 'combos.id');
            })->get(),
            'product_id' => $id,
            'product_combos' => Combo::whereHas('products', function ($query) use ($id) {
                $query->where('products.id', $id);
            })->get(),
        ]);
    }



    //store new extra 
    public function store_combo(StoreProductComboRequest $request){
        try{

            $product_combo = ProductComobs::where('product_id' , $request->product_id)->where('combo_id' , $request->extra_id)->first();
            if(isset($product_combo)){
                Alert::error('error', 'This Combo Added Before');
                return redirect()->back();
            }
            DB::beginTransaction();
            $product_type = new ProductComobs();
            $product_type->combo_id = $request->combo_id;
            $product_type->product_id = $request->product_id;
            $product_type->save();
            DB::commit();
            Alert::success('Success', 'Combo Added To Product Successfully !');
            return redirect()->back();
        }catch(\Exception $e){
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.products.index');

        }


    }

    // delete extra from product
    public function destroy_combo($product_id , $combo_id){
        $product_combo = ProductComobs::where('product_id' , $product_id)->where('combo_id' , $combo_id)->first();
        if(isset($product_combo)){
            $product_combo->delete();
            Alert::success('Success', 'Combo Removed From Product Successfully !');
            return redirect()->back();
        }

        Alert::error('error', 'Tell The Programmer To solve Error');
        return redirect()->back();

    }







}
