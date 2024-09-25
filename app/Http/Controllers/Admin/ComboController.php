<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EditComboRequest;
use App\Http\Requests\Admin\StoreComboRequest;
use App\Models\Admin\Combo;
use App\Models\Admin\Lang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ComboController extends Controller
{

    protected $langs;
    //
    public function __construct(){
        $this->langs = Lang::all();
        
    }
    public function get(){
        return view('admin.combo.index' , [ 'combos' => Combo::all()]);

    }

    public function create(){
        return view('admin.combo.create' , ['langs'=>$this->langs]);
    }

    public function edit($id){
        return view('admin.combo.edit' , ['langs'=>$this->langs , 'combo' => Combo::findOrFail($id)]);

    }

    // store new combo
    public function store(StoreComboRequest $request){
        try {
            DB::beginTransaction();
            $image_name = null;
            if($request->has('photo')){
                $image_name = $request->photo->getClientOriginalName();
                $request->photo->move(public_path('uploads/images/combos'), $image_name);
            }
            $combo = new Combo();
            $combo->price = $request->price;
            $combo->photo = $image_name;
            foreach ($this->langs as $lang) {
                $combo->{'name:'.$lang->code}  = $request->name[$lang->code];
                $combo->{'des:'.$lang->code}  = $request->des[$lang->code];
            }
            $combo->save();
            DB::commit();
            Alert::success('Success', 'Combo Added Successfully !');
            return redirect()->route('admin.combo.index');
        }catch (\Exception $e){
            dd($e->getLine() , $e->getMessage());
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.combo.index');
        }
    }

    //update comob
    public function update(EditComboRequest $request , $id){
        try{
            $comob = Combo::findOrFail($id);
            DB::beginTransaction();
            if($request->has('photo')){
                $image_name = $request->photo->getClientOriginalName();
                $request->photo->move(public_path('uploads/images/combos'), $image_name);
                $comob->photo = $image_name;
            }
            $comob->price = $request->price;
            foreach ($this->langs as $lang) {
                $comob->{'name:'.$lang->code}  = $request->name[$lang->code];
                $comob->{'des:'.$lang->code}  = $request->des[$lang->code];

            }
            $comob->save();
            DB::commit();
            Alert::success('Success', 'Combo Updated Successfully !');
            return redirect()->route('admin.combo.index');
        }catch (\Exception $e){
            dd($e->getMessage() , $e->getLine());
            Alert::error('error', 'Tell The Programmer To solve Error');
            DB::rollBack();
            return redirect()->route('admin.combo.index');

        }
    } // end update function 




    public function delete($id){
        $combo = Combo::findOrFail($id);
        $combo->delete();
        Alert::success('Success', 'Combo Deleted Successfully !');
        return redirect()->route('admin.combo.index');

    }






}
