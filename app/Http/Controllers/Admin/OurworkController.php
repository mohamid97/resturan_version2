<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateOurWork;
use App\Http\Requests\Admin\EditOurWorkRequest;
use App\Models\Admin\Lang;
use App\Models\Admin\MediaGroup;
use App\Models\Admin\Ourwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class OurworkController extends Controller
{
    private $langs;
    public function __construct()
    {
        $this->langs = Lang::all();
    }

    //
    public function index()
    {

        $our_works = Ourwork::withTrashed()->get();
        return view('admin.ourworks.index' , ['our_works'=>$our_works , 'langs'=>$this->langs]);

    }

    public function edit($id)
    {
        $medias = MediaGroup::get();
        $our_works = Ourwork::with('media')->findOrFail($id);
        return view('admin.ourworks.update' , ['our_works' => $our_works , 'langs' => $this->langs , 'medias'=>$medias]);

    }


    public function update(EditOurWorkRequest $request , $id)
    {
        try {

            DB::beginTransaction();
            $image_name = null;
            $icon_name = null;
            $Ourwork = Ourwork::findOrFail($id);
            if($request->has('photo')){
                $image_name = $request->photo->getClientOriginalName();
                $request->photo->move(public_path('uploads/images/ourworks'), $image_name);
                if ($Ourwork->photo != null && file_exists(public_path('uploads/images/ourworks/' .$Ourwork->photo))) {
                    unlink(public_path('uploads/images/ourworks/' .$Ourwork->photo));
                }

            }


            if($request->has('icon')){
                $icon_name = $request->icon->getClientOriginalName();
                $request->icon->move(public_path('uploads/images/ourworks'), $icon_name);
                if ($Ourwork->icon != null && file_exists(public_path('uploads/images/ourworks/' .$Ourwork->icon))) {
                    unlink(public_path('uploads/images/ourworks/' .$Ourwork->icon));
                }

            }

            $Ourwork->update([
                'photo'     => ( $image_name != null) ? $image_name : $Ourwork->photo,
                'icon'      => ( $icon_name != null) ? $icon_name : $Ourwork->icon,
                'link'      => $request->link,
                'media_id'  => $request->media_id
            ]);

            foreach ($this->langs as $lang) {
                $Ourwork->{'name:'.$lang->code}  = $request->name[$lang->code];
                $Ourwork->{'des:'.$lang->code}  = $request->des[$lang->code];
                $Ourwork->{'title_image:'.$lang->code}  = $request->title_image[$lang->code];
                $Ourwork->{'alt_image:'.$lang->code}  = $request->alt_image[$lang->code];
                $Ourwork->{'meta_des:'.$lang->code}  = $request->meta_des[$lang->code];
                $Ourwork->{'meta_title:'.$lang->code}  = $request->meta_title[$lang->code];

            }

            $Ourwork->save();
            DB::commit();
            Alert::success('success', 'Our Work  Updated Successfully !');
            return redirect()->route('admin.our_works.index');

        }catch (\Exception $e){
            dd($e->getLine() , $e->getMessage());
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.our_works.index');
        }

    } // end update our works


    public function create()
    {
        $medias = MediaGroup::get();
        return view('admin.ourworks.add' , ['langs'=>$this->langs , 'medias'=>$medias]);

    }

    public function store(CreateOurWork $request)
    {

        try {
            DB::beginTransaction();
            $icon_name= null;
            $image_name = null;
            if($request->has('icon')){
                $icon_name = $request->icon->getClientOriginalName();
                $request->icon->move(public_path('uploads/images/ourworks'), $icon_name);
            }
            if($request->has('photo')){
                $image_name = $request->photo->getClientOriginalName();
                $request->photo->move(public_path('uploads/images/ourworks'), $image_name);
            }

            $ourwork = new Ourwork();
            $ourwork->icon = $icon_name;
            $ourwork->photo = $image_name;
            $ourwork->link = $request->link;
            $ourwork->media_id = $request->media_id;
            foreach ($this->langs as $lang) {
                $ourwork->{'name:'.$lang->code}  = $request->name[$lang->code];
                $ourwork->{'des:'.$lang->code}  = $request->des[$lang->code];
                $ourwork->{'title_image:'.$lang->code}  = $request->title_image[$lang->code];
                $ourwork->{'alt_image:'.$lang->code}  = $request->alt_image[$lang->code];
                $ourwork->{'meta_des:'.$lang->code}  = $request->meta_des[$lang->code];
                $ourwork->{'meta_title:'.$lang->code}  = $request->meta_title[$lang->code];

            }
            $ourwork->save();
            DB::commit();
            Alert::success('Success', 'Our Work Updated Successfully ! !');
            return redirect()->route('admin.our_works.index');
        }catch(\Exception $e){
            dd($e->getLine() , $e->getMessage());
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.our_works.index');
        }


    }


    public function destroy($id)
    {
        $our_work = Ourwork::findOrFail($id);
        $our_work->forceDelete();
        Alert::success('success', 'Our Work Deleted Successfully !');
        return redirect()->route('admin.our_works.index');
    }

    public function soft_delete($id)
    {
        $our_work = Ourwork::findOrFail($id);
        $our_work->delete();
        Alert::success('success', 'Our Work Soft Deleted Successfully !');
        return redirect()->route('admin.our_works.index');

    }

    public function restore($id)
    {
        $our_work = Ourwork::withTrashed()->findOrFail($id);
        $our_work->restore();
        Alert::success('success', 'Our Works Restored Successfully !');
        return redirect()->route('admin.our_works.index');

    }
}
