<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCmsRequest;
use App\Http\Requests\Admin\UpdateCmsRequest;
use App\Models\Admin\Cms;
use App\Models\Admin\Lang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class CMSController extends Controller
{
    private $langs;
    public function __construct()
    {
        $this->langs = Lang::all();
    }

    //
    public function index()
    {
        $cms = Cms::withTrashed()->get();
        return view('admin.cms.index' , ['cms'=> $cms , 'langs'=> $this->langs]);

    }

    public function create()
    {
        return view('admin.cms.add' , ['langs' => $this->langs]);

    }

    public function store(StoreCmsRequest $request)
    {
  
        try{

            $image_name ='';
            if($request->has('image')){        
                $image_name = time() . $request->image->getClientOriginalName();
                $request->image->move(public_path('uploads/images/cms'), $image_name);
            }

        
            DB::beginTransaction();
            $cms = Cms::create([
                'status'=>'active',
                'image' => $image_name
            ]);
      
            foreach ($this->langs as $lang) {
                $cms->{'alt_image:'.$lang->code}  = $request->alt_image[$lang->code];
                $cms->{'name:'.$lang->code}  = $request->title[$lang->code];
                $cms->{'slug:'.$lang->code}  = $request->slug[$lang->code];
                $cms->{'title_image:'.$lang->code}  = $request->title_image[$lang->code];
                $cms->{'des:'.$lang->code}  = $request->des[$lang->code];
                $cms->{'small_des:'.$lang->code}  = $request->small_des[$lang->code];
                $cms->{'meta_title:'.$lang->code}  = $request->meta_title[$lang->code];
                $cms->{'meta_des:'.$lang->code}  = $request->meta_des[$lang->code];
            }
            $cms->save();
            DB::commit();
            Alert::success('Success', 'Your Post saved !');
            return redirect()->route('admin.cms.index');

        }catch(\Exception $e){
            dd($e->getMessage() , $e->getLine());
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.cms.index');
        }

    }

    public function edit($id){
        try{
            return view('admin.cms.update' , ['blog'=> Cms::findOrFail($id) , 'langs'=> $this->langs]);

        }catch(\Exception $e){
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.cms.index'); 
        }
    }

    public function update(UpdateCmsRequest $request , $id)
    {

        try{
            DB::beginTransaction();
            $cms = Cms::findOrFail($id);
            if ($request->has('image')) {
                $image_name = time() . $request->image->getClientOriginalName();
                $request->image->move(public_path('uploads/images/cms'), $image_name);
                if ($cms->image && file_exists(public_path('uploads/images/cms/' . $cms->image))) {
                    unlink(public_path('uploads/images/cms/' . $cms->image));
                }
                $cms->image = $image_name;
            }

            foreach ($this->langs as $lang) {
                $cms->{'alt_image:' . $lang->code} = $request->alt_image[$lang->code];
                $cms->{'name:' . $lang->code} = $request->title[$lang->code];
                $cms->{'slug:' . $lang->code} = $request->slug[$lang->code];
                $cms->{'title_image:' . $lang->code} = $request->title_image[$lang->code];
                $cms->{'des:' . $lang->code} = $request->des[$lang->code];
                $cms->{'small_des:'.$lang->code}  = $request->small_des[$lang->code];
                $cms->{'meta_title:' . $lang->code} = $request->meta_title[$lang->code];
                $cms->{'meta_des:' . $lang->code} = $request->meta_des[$lang->code];
            }

            $cms->save();
            DB::commit();
            Alert::success('Success', 'Your Article updated successfully!');
            return redirect()->route('admin.cms.index');


        }catch(\Exception $e){
            DB::rollBack();
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString()); 
        }

    }

    public function destroy($id)
    {
        $cms = Cms::findOrFail($id);
        $cms->forceDelete();
        Alert::success('success', 'CMS Deleted Successfully !');
        return redirect()->route('admin.cms.index');
    }

    public function soft_delete($id)
    {
        $cms = Cms::findOrFail($id);
        $cms->delete();
        Alert::success('success', 'CMS Soft Deleted Successfully !');
        return redirect()->route('admin.cms.index');
    }

    public function restore($id)
    {
        $cms = Cms::withTrashed()->findOrFail($id);
        $cms->restore();
        Alert::success('success', 'CMS Restored Successfully !');
        return redirect()->route('admin.cms.index');

    }



}
