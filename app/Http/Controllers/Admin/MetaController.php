<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MetaPages;
use App\Http\Requests\Admin\UpdateMetaRequest;
use App\Models\Admin\Lang;
use App\Models\Admin\Meta;
use App\Models\Admin\MetaBlogs;
use App\Models\Admin\MetaCategory;
use App\Models\Admin\MetaProducts;
use App\Models\Admin\MetaProjects;
use App\Models\Admin\MetaServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class MetaController extends Controller
{
    protected $langs;

    public function __construct()
    {
        $this->langs  = Lang::all();
    }

    //
    public function index()
    {
        $meta = Meta::first();

        return view('admin.meta.index' , ['meta'=>$meta ,'langs'=>$this->langs]);

    }

    public function update(UpdateMetaRequest $request)
    {
        try {
            DB::beginTransaction();
            $meta = Meta::first();
            $langs = Lang::all();
            if(isset($meta)){
                // Update existing model
                $meta->update([
                    'author' => $request->author,
                    'website_name' => $request->website_name,
                    'website_des' => $request->website_des,
                ]);
            }else{
                $meta = New Meta();
                $meta->author         = $request->author;
                $meta->website_name   = $request->website_name;
                $meta->website_des    = $request->website_des;
            }
            foreach ($langs as $lang) {
                $meta->{'meta_keywords:'.$lang->code}  = $request->meta_keywords[$lang->code];
                $meta->{'meta_tags:'.$lang->code}      = $request->meta_tags[$lang->code];
                $meta->{'meta_des:'.$lang->code}       = $request->meta_des[$lang->code];
                $meta->{'meta_title:'.$lang->code}       = $request->meta_title[$lang->code];
            }
            $meta->save();

            DB::commit();
            Alert::success('Success', 'Updated Successfully ! !');
            return redirect()->route('admin.meta.index');

        }catch(\Exception $e){
            dd($e->getMessage() , $e->getLine());

            // If an exception occurs, rollback the transaction
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.meta.index');
        }


    }  //end update function


    public function blogs()
    {
        $meta = MetaBlogs::first();
        return view('admin.meta.blogs' , ['meta'=>$meta ,'langs'=>$this->langs]);
    }


    public function projects()
    {
        $meta = Meta::first();
        return view('admin.meta.blogs' , ['meta'=>$meta ,'langs'=>$this->langs]);
    }


    public function categories()
    {
        $meta = MetaCategory::first();
        return view('admin.meta.categories' , ['meta'=>$meta ,'langs'=>$this->langs]);
    }


    public function products()
    {
        $meta = MetaProducts::first();
        return view('admin.meta.products' , ['meta'=>$meta ,'langs'=>$this->langs]);
    }


    public function services()
    {
        $meta = MetaServices::first();
        return view('admin.meta.services' , ['meta'=>$meta ,'langs'=>$this->langs]);
    }


    public function update_services(MetaPages $request)
    {

        try {
            DB::beginTransaction();
            $meta = MetaServices::first();
            $langs = Lang::all();
            if(!isset($meta)){
                $meta = New MetaServices();
                $meta->type   = 'accept';
            }
            foreach ($langs as $lang) {
                $meta->{'meta_keywords:'.$lang->code}  = $request->meta_keywords[$lang->code];
                $meta->{'meta_tags:'.$lang->code}      = $request->meta_tags[$lang->code];
                $meta->{'meta_des:'.$lang->code}       = $request->meta_des[$lang->code];
                $meta->{'meta_title:'.$lang->code}     = $request->meta_title[$lang->code];
            }

            $meta->save();

            DB::commit();
            Alert::success('Success', 'Updated Successfully ! !');
            return redirect()->route('admin.meta.services');

        }catch(\Exception $e){
            dd($e->getMessage() , $e->getLine());

            // If an exception occurs, rollback the transaction
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.meta.services');
        }

    }


    public function update_categories(MetaPages $request)
    {

        try {
            DB::beginTransaction();
            $meta = MetaCategory::first();
            if(!isset($meta)){
                $meta = New MetaCategory();
                $meta->type   = '1';
                $meta->save();
            }
            foreach ($this->langs as $lang) {
                $meta->{'meta_keywords:'.$lang->code}  = $request->meta_keywords[$lang->code];
                $meta->{'meta_tags:'.$lang->code}      = $request->meta_tags[$lang->code];
                $meta->{'meta_des:'.$lang->code}       = $request->meta_des[$lang->code];
                $meta->{'meta_title:'.$lang->code}     = $request->meta_title[$lang->code];
            }

            $meta->save();

            DB::commit();
            Alert::success('Success', 'Updated Successfully ! !');
            return redirect()->route('admin.meta.categories');

        }catch(\Exception $e){
            dd($e->getMessage() , $e->getLine());

            // If an exception occurs, rollback the transaction
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.meta.categories');
        }

    }

    public function update_blogs(MetaPages $request)
    {
        try {
            DB::beginTransaction();
            $meta = MetaBlogs::first();
            if(!isset($meta)){
                $meta = New MetaBlogs();
                $meta->status   = 'approved';
            }
            foreach ($this->langs as $lang) {
                $meta->{'meta_keywords:'.$lang->code}  = $request->meta_keywords[$lang->code];
                $meta->{'meta_tags:'.$lang->code}      = $request->meta_tags[$lang->code];
                $meta->{'meta_des:'.$lang->code}       = $request->meta_des[$lang->code];
                $meta->{'meta_title:'.$lang->code}     = $request->meta_title[$lang->code];
            }

            $meta->save();

            DB::commit();
            Alert::success('Success', 'Updated Successfully ! !');
            return redirect()->route('admin.meta.blogs');

        }catch(\Exception $e){
            dd($e->getMessage() , $e->getLine());

            // If an exception occurs, rollback the transaction
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.meta.blogs');
        }

    }



    public function update_projects(MetaPages $request)
    {
        try {
            DB::beginTransaction();
            $meta = MetaProjects::first();
            if(!isset($meta)){
                $meta = New MetaProjects();
                $meta->type   = 'accept';
            }
            foreach ($this->langs as $lang) {
                $meta->{'meta_keywords:'.$lang->code}  = $request->meta_keywords[$lang->code];
                $meta->{'meta_tags:'.$lang->code}      = $request->meta_tags[$lang->code];
                $meta->{'meta_des:'.$lang->code}       = $request->meta_des[$lang->code];
                $meta->{'meta_title:'.$lang->code}     = $request->meta_title[$lang->code];
            }

            $meta->save();

            DB::commit();
            Alert::success('Success', 'Updated Successfully ! !');
            return redirect()->route('admin.meta.projects');

        }catch(\Exception $e){
            dd($e->getMessage() , $e->getLine());

            // If an exception occurs, rollback the transaction
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.meta.projects');
        }

    }




    public function update_products(MetaPages $request)
    {
        try {
            DB::beginTransaction();
            $meta = MetaProducts::first();
            if(!isset($meta)){
                $meta = New MetaProducts();
                $meta->type   = '1';
            }
            foreach ($this->langs as $lang) {
                $meta->{'meta_keywords:'.$lang->code}  = $request->meta_keywords[$lang->code];
                $meta->{'meta_tags:'.$lang->code}      = $request->meta_tags[$lang->code];
                $meta->{'meta_des:'.$lang->code}       = $request->meta_des[$lang->code];
                $meta->{'meta_title:'.$lang->code}     = $request->meta_title[$lang->code];
            }

            $meta->save();

            DB::commit();
            Alert::success('Success', 'Updated Successfully ! !');
            return redirect()->route('admin.meta.products');

        }catch(\Exception $e){
            dd($e->getMessage() , $e->getLine());

            // If an exception occurs, rollback the transaction
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.meta.products');
        }

    }



}
