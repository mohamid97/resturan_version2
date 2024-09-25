<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GalleryImageRequest;
use App\Models\Admin\GalleryImage;
use App\Models\Admin\Lang;
use App\Models\Admin\MediaGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class GalleryController extends Controller
{

    private $langs;

    public function __construct()
    {
        $this->langs = Lang::all();
    }

    // get gallery
    public function gallery()
    {
        $gallerys = GalleryImage::withTrashed()->get();
        return view('admin.media.gallery.index' ,['gallerys' => $gallerys , 'langs'=> $this->langs]);
    }

    // return to create page
    public function create(){
        $media_groups = MediaGroup::all();
        return view('admin.media.gallery.add' , ['langs'=> $this->langs , 'media_groups'=>$media_groups]);
    }

    // store glalery
    public function store(GalleryImageRequest $request)
    {
   
        
        try {

            DB::beginTransaction();
            $image_name = '';
            if($request->has('photo')){
                $image_name = $request->photo->getClientOriginalName();
                $request->photo->move(public_path('uploads/images/media/gallery'), $image_name);
            }
            $gallery = GalleryImage::create([
                'photo' => $image_name,
                'media_group_id' => $request->group_media
            ]);

            foreach ($this->langs as $lang) {
                $gallery->{'name:'.$lang->code}  = $request->name[$lang->code];
                $gallery->{'alt_image:'.$lang->code}  = $request->alt_image[$lang->code];
                $gallery->{'title_image:'.$lang->code}  = $request->title_image[$lang->code];
            }
            $gallery->save();

            DB::commit();
            Alert::success('Success', 'Gallery Added Successfully !');
            return redirect()->route('admin.media.gallery');

        }catch(\Exception $e){
            DB::rollBack();
            dd($e->getLine() , $e->getMessage());
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.media.gallery');

        }


    }

    public function edit($id)
    {
        try {
            $gallery = GalleryImage::findOrFail($id);
            $media_groups = MediaGroup::all();
            return view('admin.media.gallery.update' , ['langs' => $this->langs , 'gallery'=> $gallery , 'media_groups'=>$media_groups]);
        }catch (\Exception $e){
            dd($e->getLine() , $e->getMessage());
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.media.gallery');
        }

    }

    public function update(Request $request , $id)
    {
        try {
            DB::beginTransaction();
            $gallery = GalleryImage::findOrFail($id);
            if($request->has('photo')){
                $image_name = $request->photo->getClientOriginalName();
                $request->photo->move(public_path('uploads/images/media/gallery'), $image_name);
                $gallery->update([
                    'photo'=>$image_name,
                    'media_group_id' => $request->group_media
                ]);
            }

            foreach ($this->langs as $lang) {
                $gallery->{'name:'.$lang->code}  = $request->name[$lang->code];
                $gallery->{'alt_image:'.$lang->code}  = $request->alt_image[$lang->code];
                $gallery->{'title_image:'.$lang->code}  = $request->title_image[$lang->code];
            }
            $gallery->save();

            DB::commit();
            Alert::success('Success', 'Category Added Successfully !');
            return redirect()->route('admin.media.gallery');
        }catch (\Exception $e){
            DB::rollBack();
            dd($e->getLine() , $e->getMessage());
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.media.gallery.index');
        }


    }


    public function destroy($id)
    {
        $gallery = GalleryImage::findOrFail($id);
        $gallery->forceDelete();
        Alert::success('success', 'Gallery Image Deleted Successfully !');
        return redirect()->route('admin.media.gallery');
    }

    public function soft_delete($id)
    {
        $gallery = GalleryImage::findOrFail($id);
        $gallery->delete();
        Alert::success('success', 'Gallery Image  Soft Deleted Successfully !');
        return redirect()->route('admin.media.gallery');

    }

    public function restore($id)
    {
        $gallery = GalleryImage::withTrashed()->findOrFail($id);
        $gallery->restore();
        Alert::success('success', 'Gallery Image Restored Successfully !');
        return redirect()->route('admin.media.gallery');

    }
}
