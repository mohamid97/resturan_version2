<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Admin\Category;
use App\Models\Admin\Lang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    protected $langs;
    //

    public function __construct()
    {
        $this->langs = Lang::all();
    }

    public function index()
    {
        $categories = Category::withTrashed()->get();
        return view('admin.category.index' , ['categories'=>$categories , 'langs'=>$this->langs]);

    }


    public function create()
    {
        $categories = Category::all();
        return view('admin.category.add' , ['langs' => $this->langs , 'categories' => $categories]);

    }

    public function edit($id)
    {
        $cat = Category::findOrFail($id);
        $categories = Category::all();
        return view('admin.category.update' , ['cat' => $cat , 'langs' => $this->langs , 'categories'=>$categories]);

    }

    public function store(StoreCategoryRequest $request)
    {
        try {
            DB::beginTransaction();
            $image_name = null;
            if($request->has('photo')){
                $image_name = $request->photo->getClientOriginalName();
                $request->photo->move(public_path('uploads/images/category'), $image_name);
            }
            $categry = new Category();
            $categry->type = $request->type;
            $categry->has_options = $request->has_options;
            $categry->parent_id = ($request->type == 1) ? $request->type : null;
            $categry->photo = $image_name;
            $categry->star = $request->star;
            foreach ($this->langs as $lang) {
                $categry->{'name:'.$lang->code}  = $request->name[$lang->code];
                $categry->{'des:'.$lang->code}  = $request->des[$lang->code];
                $categry->{'small_des:'.$lang->code}  = $request->small_des[$lang->code];
                $categry->{'slug:'.$lang->code}  = $request->slug[$lang->code];
                $categry->{'alt_image:'.$lang->code}  = $request->alt_image[$lang->code];
                $categry->{'title_image:'.$lang->code}  = $request->title_image[$lang->code];
                $categry->{'meta_title:'.$lang->code}  = $request->meta_title[$lang->code];
                $categry->{'meta_des:'.$lang->code}  = $request->meta_des[$lang->code];
            }
            $categry->save();
            DB::commit();
            Alert::success('Success', 'Category Added Successfully !');
            return redirect()->route('admin.category.index');
        }catch (\Exception $e){
            dd($e->getLine() , $e->getMessage());
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.category.index');
        }
    }

    public function update(UpdateCategoryRequest $request , $id)
    {
       try{
           $cat = Category::findOrFail($id);

           DB::beginTransaction();
           $image_name = null;
           if($request->has('photo')){
               $image_name = $request->photo->getClientOriginalName();
               $request->photo->move(public_path('uploads/images/category'), $image_name);
           }
           $cat->type = $request->type;
           $cat->has_options = $request->has_options;
           $cat->parent_id = ($request->type == 1) ? $request->type : null;
           $cat->photo = ($image_name != null) ? $image_name : $cat->photo;
           $cat->star = isset($request->star) ? $request->star : null;
           foreach ($this->langs as $lang) {
               $cat->{'name:'.$lang->code}  = $request->name[$lang->code];
               $cat->{'des:'.$lang->code}  = $request->des[$lang->code];
               $cat->{'small_des:'.$lang->code}  = $request->small_des[$lang->code];
               $cat->{'slug:'.$lang->code}  = $request->slug[$lang->code];
               $cat->{'alt_image:'.$lang->code}  = $request->alt_image[$lang->code];
               $cat->{'title_image:'.$lang->code}  = $request->title_image[$lang->code];
               $cat->{'meta_title:'.$lang->code}  = $request->meta_title[$lang->code];
               $cat->{'meta_des:'.$lang->code}  = $request->meta_des[$lang->code];
           }
           $cat->save();
           DB::commit();
           Alert::success('Success', 'Category Updated Successfully !');
           return redirect()->route('admin.category.index');
       }catch (\Exception $e){
           dd($e->getMessage() , $e->getLine());
           Alert::error('error', 'Tell The Programmer To solve Error');
           DB::rollBack();
       }

    } // end update category

    public function destroy($id)
    {
        $cat = Category::findOrFail($id);
        $cat->forceDelete();
        Alert::success('success', 'Category Deleted Successfully !');
        return redirect()->route('admin.category.index');
    }

    public function soft_delete($id)
    {
        $cat = Category::findOrFail($id);
        $cat->delete();
        Alert::success('success', 'Category Soft Deleted Successfully !');
        return redirect()->route('admin.category.index');

    }

    public function restore($id)
    {
        $cat = Category::withTrashed()->findOrFail($id);
        $cat->restore();
        Alert::success('success', 'Category Restored Successfully !');
        return redirect()->route('admin.category.index');

    }
}
