<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVideoRequest;
use App\Models\Admin\Lang;
use App\Models\Admin\MediaGroup;
use App\Models\Admin\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class VideoController extends Controller
{

    private $langs;

    public function __construct()
    {
        $this->langs = Lang::all();
    }

    // get gallery
    public function videos()
    {
        $videos = Video::withTrashed()->get();
        return view('admin.media.videos.index' ,['videos' => $videos , 'langs'=> $this->langs]);
    }

    // return to create page
    public function create(){
        $media_groups = MediaGroup::all();
        return view('admin.media.videos.add' , ['langs'=> $this->langs ,'media_groups'=>$media_groups]);
    }

    // store glalery
    public function store(StoreVideoRequest $request)
    {

        try {
            DB::beginTransaction();
            $image_name = null;
            if($request->has('photo')){
                $image_name = $request->photo->getClientOriginalName();
                $request->photo->move(public_path('uploads/images/media/videos'), $image_name);
            }
            $video = Video::create([
                'image' => $image_name,
                'link'  => $request->link,
                'media_group_id' => $request->group_media
            ]);
            foreach ($this->langs as $lang) {
                $video->{'name:'.$lang->code}  = $request->name[$lang->code];
                $video->{'des:'.$lang->code}  = $request->des[$lang->code];
            }
            $video->save();
            DB::commit();
            Alert::success('Success', 'Video Added Successfully !');
            return redirect()->route('admin.media.videos');
        }catch(\Exception $e){
            DB::rollBack();
            dd($e->getLine() , $e->getMessage());
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.media.videos');

        }


    }

    public function edit($id)
    {
        try {
            $video = Video::findOrFail($id);
            $media_groups = MediaGroup::all();
            return view('admin.media.videos.update' , ['langs' => $this->langs , 'video'=> $video , 'media_groups'=>$media_groups]);
        }catch (\Exception $e){
            dd($e->getLine() , $e->getMessage());
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.media.videos');
        }

    }

    public function update(StoreVideoRequest $request , $id)
    {

        try {
            DB::beginTransaction();
            $video = Video::findOrFail($id);
            if($request->has('photo')){
                $image_name = $request->photo->getClientOriginalName();
                $request->photo->move(public_path('uploads/images/media/videos'), $image_name);
                $video->update([
                    'photo'=>$image_name,
                ]);
            }

            $video->update([
                'link'=>$request->link,
                'media_group_id' => $request->group_media
            ]);

            foreach ($this->langs as $lang) {
                $video->{'name:'.$lang->code}  = $request->name[$lang->code];
                $video->{'des:'.$lang->code}  = $request->des[$lang->code];
            }
            $video->save();

            DB::commit();
            Alert::success('Success', 'Video Added Successfully !');
            return redirect()->route('admin.media.videos');
        }catch (\Exception $e){
            DB::rollBack();
            dd($e->getLine() , $e->getMessage());
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.media.videos');
        }


    }





    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->forceDelete();
        Alert::success('success', 'Video  Deleted Successfully !');
        return redirect()->route('admin.media.videos');
    }

    public function soft_delete($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();
        Alert::success('success', 'Video   Soft Deleted Successfully !');
        return redirect()->route('admin.media.videos');

    }

    public function restore($id)
    {
        $video = Video::withTrashed()->findOrFail($id);
        $video->restore();
        Alert::success('success', 'Video  Restored Successfully !');
        return redirect()->route('admin.media.videos');

    }
}
