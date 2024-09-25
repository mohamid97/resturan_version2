<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DesRequest;
use App\Models\Admin\Des;
use App\Models\Admin\Lang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class DesController extends Controller
{
    private $langs;
    //
    public function __construct()
    {
        $this->langs  = Lang::all();

    }

    public function index()
    {
        $de = Des::withTrashed()->get();
        return view('admin.des.index' , ['langs' => $this->langs , 'des'=> $de]);

    }

    public function create()
    {
        return view('admin.des.add' , ['langs'=> $this->langs]);

    }

    public function store(DesRequest $request)
    {
        try {
            DB::beginTransaction();
            $image_name = null;
            if($request->has('image')){
                $image_name = $request->image->getClientOriginalName();
                $request->image->move(public_path('uploads/images/des'), $image_name);
            }


             $des = Des::create([
                 'type'=>'other',
                 'image'=> $image_name
             ]);

            foreach ($this->langs as $lang) {
                $des->{'name:'.$lang->code}       = $request->name[$lang->code];
                $des->{'des:'.$lang->code}  = $request->des[$lang->code];
                $des->{'alt_image:'.$lang->code}  = $request->alt_image[$lang->code];
                $des->{'title_image:'.$lang->code}  = $request->title_image[$lang->code];


            }
            $des->save();
            DB::commit();
            Alert::success('success', 'Description Added Successfully !');
            return redirect()->route('admin.des.index');

        }catch (\Exception $e){
            dd($e->getMessage() , $e->getLine());
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.des.index');

        }


    }


    public function edit($id)
    {
        try{
            $des = Des::findOrFail($id);
            return view('admin.des.update' , ['langs' => $this->langs , 'des' => $des]);
            Alert::success('success', 'Description Added Successfully !');
            return redirect()->route('admin.des.index');
        }catch (\Exception $e){
            dd($e->getMessage() , $e->getLine());
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.des.index');
        }

    }

    public function update(DesRequest $request , $id)
    {
        try {
            DB::beginTransaction();

            $des = Des::findOrFail($id);  
            if($request->has('image')){
                $image_name = $request->image->getClientOriginalName();
                $request->image->move(public_path('uploads/images/des'), $image_name);
                if (isset($des->image) && file_exists(public_path('uploads/images/des/' .$des->image))) {
                    unlink(public_path('uploads/images/des/' .$des->image));
                }

                $des->image = $image_name;
                $des->save();
            }


            foreach ($this->langs as $lang) {
                $des->{'name:'.$lang->code}       = $request->name[$lang->code];
                $des->{'des:'.$lang->code}  = $request->des[$lang->code];
                $des->{'alt_image:'.$lang->code}  = $request->alt_image[$lang->code];
                $des->{'title_image:'.$lang->code}  = $request->title_image[$lang->code];

            }
            $des->save();
            DB::commit();
            Alert::success('success', 'Description Updated Successfully !');
            return redirect()->route('admin.des.index');
        }catch (\Exception $e){
            dd($e->getMessage() , $e->getLine());
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.des.index');
        }

    }


    public function destroy($id)
    {
        $des = Des::findOrFail($id);
        $des->forceDelete();
        Alert::success('success', 'Description Deleted Successfully !');
        return redirect()->route('admin.des.index');
    }

    public function soft_delete($id)
    {
        $des = Des::findOrFail($id);
        $des->delete();
        Alert::success('success', 'Description Soft Deleted Successfully !');
        return redirect()->route('admin.des.index');

    }

    public function restore($id)
    {
        $des = Des::withTrashed()->findOrFail($id);
        $des->restore();
        Alert::success('success', 'Description Restored Successfully !');
        return redirect()->route('admin.des.index');

    }
}
