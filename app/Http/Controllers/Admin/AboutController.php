<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\Admin\AboutRequest;
use App\Http\Controllers\Controller;
use App\Models\Admin\Lang;
use Illuminate\Http\Request;
use App\Models\Admin\About;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AboutController extends Controller
{

    protected $langs;
    public function __construct()
    {
        $this->langs = Lang::all();
    }
    // index for about 
    public function index()
    {
        $about = About::first();
        return view('admin.about.index' ,['about'=> $about , 'langs' => $this->langs ]);
    }
    public function update(AboutRequest $request , $id)
    {
        // start try 
        try{
            // strart try transcation
            DB::beginTransaction();
            $about = About::first();
            if($request->has('photo')){
                $image_name = $request->photo->getClientOriginalName();
                $request->photo->move(public_path('uploads/images/about'), $image_name);
                if (isset($about->photo) && file_exists(public_path('uploads/images/about/' .$about->photo))) {
                    unlink(public_path('uploads/images/about/' .$about->photo));
                }
                $about->photo = $image_name;
            }
            $about->phone = $request->phone;
            // loop for about  translation 
            foreach ($this->langs as $lang) {
                $about->{'name:'.$lang->code}         = $request->name[$lang->code];
                $about->{'des:'.$lang->code}          = $request->des[$lang->code];
                $about->{'meta_title:'.$lang->code}   = $request->meta_title[$lang->code];
                $about->{'meta_des:'.$lang->code}     = $request->meta_des[$lang->code];
                $about->{'title_image:'.$lang->code}  = $request->title_image[$lang->code];
                $about->{'alt_image:'.$lang->code}    = $request->alt_image[$lang->code];
            }

            $about->save();
            // commit transaction
            DB::commit();
            Alert::success('Success', 'Updated Successfully ! !');
            return redirect()->route('admin.about.index');

        }catch(\Exception $e){
           
            // If an exception occurs, rollback the transaction
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.about.index');
        }// end catach


    } // end update function
}
