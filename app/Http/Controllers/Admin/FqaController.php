<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqRequest;
use App\Http\Requests\Admin\MainfaqRequest;
use App\Models\Admin\Faq;
use App\Models\Admin\Lang;
use App\Models\Admin\MainFaq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class FqaController extends Controller
{

    protected $langs;
    //

    public function __construct()
    {
        $this->langs = Lang::all();
    }

    public function get_main_faq(){
        return view('admin.faq.main_faq' , ['main_faq'=> MainFaq::first() , 'langs'=>$this->langs]);
    }

    public function update_main_faq(MainfaqRequest $request){

                // start try 
                try{
                    // strart try transcation
                    DB::beginTransaction();
                    $mainfaq = MainFaq::first();
                    if(!isset($mainfaq)){
                        $mainfaq = new MainFaq();
                    }
                    if($request->has('photo')){
                        $image_name = $request->photo->getClientOriginalName();
                        $request->photo->move(public_path('uploads/images/main_faq'), $image_name);
                        if (isset($mainfaq) && isset($mainfaq->image) && file_exists(public_path('uploads/images/main_faq/' .$mainfaq->image))) {
                            unlink(public_path('uploads/images/main_faq/' .$mainfaq->image));
                        }
                        $mainfaq->image = $image_name;
                    }
                    // loop for about  translation 
                    foreach ($this->langs as $lang) {
                        $mainfaq->{'title:'.$lang->code}         = $request->title[$lang->code];
                        $mainfaq->{'des:'.$lang->code}          = $request->des[$lang->code];
                        $mainfaq->{'title_image:'.$lang->code}  = $request->title_image[$lang->code];
                        $mainfaq->{'alt_image:'.$lang->code}    = $request->alt_image[$lang->code];
                    }
        
                    $mainfaq->save();
                    // commit transaction
                    DB::commit();
                    Alert::success('Success', 'Updated Successfully ! !');
                    return redirect()->route('admin.main_faq.index');
        
                }catch(\Exception $e){
                   
                    // If an exception occurs, rollback the transaction
                    DB::rollBack();
                    Alert::error('error', 'Tell The Programmer To solve Error');
                    return redirect()->route('admin.main_faq.index');
                }// end catach


    }
    //
    public function get(){
        $faqs = Faq::withTrashed()->get();
        return view('admin.faq.index' , ['faqs'=>$faqs , 'langs'=>$this->langs]);

    }

    public function create() {

        return view('admin.faq.add' , ['langs'=>$this->langs]);
        
    }
    
    public function store(FaqRequest $request)  {
 
        try {
            DB::beginTransaction();

            $image_name = null;
            if($request->has('image')){
                $image_name = $request->image->getClientOriginalName();
                $request->image->move(public_path('uploads/images/faq'), $image_name);
                
            }
            $faq = new Faq();
            $faq->image = $image_name;
            foreach ($this->langs as $lang) {
                $faq->{'title:'.$lang->code}  = $request->title[$lang->code];
                $faq->{'question:'.$lang->code}  = $request->question[$lang->code];
                $faq->{'answer:'.$lang->code}  = $request->answer[$lang->code];
                $faq->{'des:'.$lang->code}  = $request->des[$lang->code];
                $faq->{'alt_image:'.$lang->code}  = $request->alt_image[$lang->code];
                $faq->{'title_image:'.$lang->code}  = $request->title_image[$lang->code];

            }
            $faq->save();
            DB::commit();
            Alert::success('Success', 'faq Added Successfully !');
            return redirect()->route('admin.faq.index');
        }catch (\Exception $e){
            dd($e->getLine() , $e->getMessage());
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.faq.index');
        }
    }

    public function edit($id){
        $faq = Faq::findOrFail($id);
        return view('admin.faq.update' , ['faq'=>$faq , 'langs'=> $this->langs]);
    }


    public function update(FaqRequest $request , $id){
        try {

            DB::beginTransaction();
            $faq = Faq::findOrFail($id);
            $image_name = null;
    
            if($request->has('image')){
                $image_name = $request->image->getClientOriginalName();
                $request->image->move(public_path('uploads/images/faq'), $image_name);
                if (isset($faq) && isset($faq->image) && file_exists(public_path('uploads/images/faq/' .$faq->image))) {
                    unlink(public_path('uploads/images/faq/' .$faq->image));
                }
                $faq->image = $image_name;
            }
           
            
            foreach ($this->langs as $lang) {
                $faq->{'title:'.$lang->code}  = $request->title[$lang->code];
                $faq->{'question:'.$lang->code}  = $request->question[$lang->code];
                $faq->{'answer:'.$lang->code}  = $request->answer[$lang->code];
                $faq->{'des:'.$lang->code}  = $request->des[$lang->code];
                $faq->{'alt_image:'.$lang->code}  = $request->alt_image[$lang->code];
                $faq->{'title_image:'.$lang->code}  = $request->title_image[$lang->code];

            }
            $faq->save();
            DB::commit();
            Alert::success('Success', 'faq Updated Successfully !');
            return redirect()->route('admin.faq.index');
        }catch (\Exception $e){
            dd($e->getLine() , $e->getMessage());
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.faq.index');
        }
    }



    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->forceDelete();
        Alert::success('success', 'Faq Deleted Successfully !');
        return redirect()->route('admin.faq.index');
    }

    public function soft_delete($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();
        Alert::success('success', 'Faq Soft Deleted Successfully !');
        return redirect()->route('admin.faq.index');

    }

    public function restore($id)
    {
        $faq = Faq::withTrashed()->findOrFail($id);
        $faq->restore();
        Alert::success('success', 'Faq Restored Successfully !');
        return redirect()->route('admin.faq.index');

    }





}
