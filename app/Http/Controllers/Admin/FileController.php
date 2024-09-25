<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FileRequest;
use App\Models\Admin\File;
use App\Models\Admin\Lang;
use App\Models\Admin\MediaGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class FileController extends Controller
{

    private $langs;

    public function __construct()
    {
        $this->langs = Lang::all();
    }

    // get gallery
    public function files()
    {
        $files = File::withTrashed()->get();
        return view('admin.media.files.index' ,['files' => $files , 'langs'=> $this->langs]);
    }

    // return to create page
    public function create(){
        $media_groups = MediaGroup::all();
        return view('admin.media.files.add' , ['langs'=> $this->langs , 'media_groups'=>$media_groups]);
    }

    // store glalery
    public function store(FileRequest $request)
    {
        try {

            DB::beginTransaction();
            if($request->has('file')){
                $file_name = $request->file->getClientOriginalName();
                $request->file->move(public_path('uploads/images/media/files'), $file_name);
                $file = File::create([
                    'file' => $file_name,
                    'media_group_id' => $request->group_media
                ]);

            }
            foreach ($this->langs as $lang) {
                $file->{'name:'. $lang->code }  = $request->name[$lang->code];
                $file->{'des:'.  $lang->code }  = $request->des[$lang->code];
            }
            $file->save();
            DB::commit();
            Alert::success('Success', 'File Added Successfully !');
            return redirect()->route('admin.media.files');
        }catch(\Exception $e){
            DB::rollBack();
            dd($e->getLine() , $e->getMessage());
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.media.files');

        }


    }

    public function edit($id)
    {
        try {
            $file = File::findOrFail($id);
            return view('admin.media.files.update' , ['langs' => $this->langs , 'file'=> $file]);
        }catch (\Exception $e){
            dd($e->getLine() , $e->getMessage());
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.media.files');
        }

    }

//    public function update(StoreVideoRequest $request , $id)
//    {
//
//        try {
//            DB::beginTransaction();
//            $video = File::findOrFail($id);
//            if($request->has('photo')){
//                $image_name = $request->photo->getClientOriginalName();
//                $request->photo->move(public_path('uploads/images/media/videos'), $image_name);
//                $video->update([
//                    'photo'=>$image_name,
//                ]);
//            }
//
//            $video->update([
//                'link'=>$request->link,
//            ]);
//
//            foreach ($this->langs as $lang) {
//                $video->{'name:'.$lang->code}  = $request->name[$lang->code];
//                $video->{'des:'.$lang->code}  = $request->des[$lang->code];
//            }
//            $video->save();
//
//            DB::commit();
//            Alert::success('Success', 'File Added Successfully !');
//            return redirect()->route('admin.media.videos');
//        }catch (\Exception $e){
//            DB::rollBack();
//            dd($e->getLine() , $e->getMessage());
//            Alert::error('error', 'Tell The Programmer To solve Error');
//            return redirect()->route('admin.media.videos');
//        }
//
//
//    }





    public function destroy($id)
    {
        $file = File::findOrFail($id);
        $file->forceDelete();
        Alert::success('success', 'File  Deleted Successfully !');
        return redirect()->route('admin.media.files');
    }

    public function soft_delete($id)
    {
        $file = File::findOrFail($id);
        $file->delete();
        Alert::success('success', 'File  Soft Deleted Successfully !');
        return redirect()->route('admin.media.files');

    }

    public function restore($id)
    {
        $file = File::withTrashed()->findOrFail($id);
        $file->restore();
        Alert::success('success', 'File  Restored Successfully !');
        return redirect()->route('admin.media.files');

    }
}
