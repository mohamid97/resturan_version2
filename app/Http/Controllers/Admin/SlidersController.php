<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Sliders;
use App\Http\Requests\Admin\updateSlidersRequest;
use App\Models\Admin\Lang;
use App\Models\Admin\Setting;
use App\Models\Admin\Slider;
use App\Models\SliderSetting;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class SlidersController extends Controller
{
    private $langs;
    public function __construct()
    {
        $this->langs = Lang::all();
    
    }

    //
    public function index()
    {
        $sliders = Slider::withTrashed()->get();
        return view('admin.sliders.index' , ['sliders' => $sliders , 'langs' => $this->langs]);
    }


    public function create()
    {
        return view('admin.sliders.add' , ['langs'=>$this->langs]);

    } // end create function


    public function store(Sliders $request)
    {

        try {
            // Start the database transaction
            $image_name = $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/images/sliders'), $image_name);
            DB::beginTransaction();
            $slider = new Slider();
            $slider->image    =  $image_name;
            $slider->arrange  = $request->arrange;
            $slider->link     = $request->link;
            foreach ($this->langs as $lang) {
                $slider->{'alt_image:'.$lang->code}  = $request->alt_image[$lang->code];
                $slider->{'name:'.$lang->code}  = $request->name[$lang->code];
                $slider->{'title_image:'.$lang->code}  = $request->title_image[$lang->code];
                $slider->{'des:'.$lang->code}  = $request->des[$lang->code];
                $slider->{'small_des:'.$lang->code}  = $request->small_des[$lang->code];
            }
            $slider->save();
            DB::commit();
            Alert::success('Success', 'Your slider is saved !');
            return redirect()->route('admin.sliders.index');

        } catch (\Exception $e) {
            dd($e->getLine() , $e->getMessage());
            // If an exception occurs, rollback the transaction
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.sliders.index');
        }
    }// end function store


    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.sliders.update' , ['slider'=> $slider , 'langs'=> $this->langs]);

    }

    public function update(updateSlidersRequest $request , $id)
    {
        try {

            $slider = Slider::findOrFail($id);
            if($request->has('image')){
                $image_name = $request->image->getClientOriginalName();
                $request->image->move(public_path('uploads/images/sliders'), $image_name);
                if (file_exists(public_path('uploads/images/sliders/' .$slider->image))) {
                    unlink(public_path('uploads/images/sliders/' .$slider->image));
                }
            }

    
             

            DB::beginTransaction();
            foreach ($this->langs as $lang) {
                $slider->{'name:'.$lang->code}       = $request->name[$lang->code];
                $slider->{'alt_image:'.$lang->code}  = $request->alt_image[$lang->code];
                $slider->{'title_image:'.$lang->code}= $request->title_image[$lang->code];
                $slider->{'des:'.$lang->code}  = $request->des[$lang->code];
                $slider->{'small_des:'.$lang->code}  = $request->small_des[$lang->code];
            }
            if(isset($image_name))
                $slider->image = $image_name;

            $slider->arrange = $request->arrange;
            $slider->link    = $request->link;
            
            $slider->save();
            DB::commit();
            Alert::success('success', 'Slider Updated Successfully !');
            return redirect()->route('admin.sliders.index');

        }catch (\Exception $e){
            // If an exception occurs, rollback the transaction
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.sliders.index');
        }

    } // end update laravel


    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->forceDelete();
        Alert::success('success', 'Slider Deleted Successfully !');
        return redirect()->route('admin.sliders.index');
    }

    public function soft_delete($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->delete();
        Alert::success('success', 'Slider Soft Deleted Successfully !');
        return redirect()->route('admin.sliders.index');

    }

    public function restore($id)
    {
        $slider = Slider::withTrashed()->findOrFail($id);
        $slider->restore();
        Alert::success('success', 'Slider Restored Successfully !');
        return redirect()->route('admin.sliders.index');

    }

    // get slider setting
    public function setting()
    {
        $setting = SliderSetting::first();
        return view('admin.sliders.settings' , ['setting'=>$setting]);

    }

    public function update_setting(Request $request)
    {

        try{
            DB::beginTransaction();
            $setting = SliderSetting::first();
            if ($setting !== null && $setting->exists()){
                $setting->update([
                    'setting' =>($request->setting == 'on' ? 'Disabled' : 'Enabled'),
                    'height'=>$request->height ? $request->height : null,
                    'width'=>$request->width ? $request->width : null,
                ]);
            }else{

                SliderSetting::create([
                    'setting' =>($request->setting == 'on' ? 'Disabled' : 'Enabled'),
                    'height'=>$request->height ? $request->height : null,
                    'width'=> $request->width ? $request->width : null,
                ]);

            }

            DB::commit();

            Alert::success('success', 'Slider Setting Updated Successfully !');
            return redirect()->route('admin.sliders.index');

        }catch (\Exception $e){
            dd($e->getLine() , $e->getMessage());
            // If an exception occurs, rollback the transaction
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.sliders.index');
        }


    } // end update setting of slider

}
