<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TypeOptionRequest;
use App\Http\Requests\Admin\TypesRequest;
use App\Models\Admin\Lang;
use App\Models\Admin\Typeoption;
use App\Models\Admin\Types;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class TypesController extends Controller
{

    protected $langs;

    public function __construct()
    {
        $this->langs = Lang::all();
        
    }

    public function get_type(){
        $types = Types::all();
        return view('admin.types.index' , ['langs'=>$this->langs , 'types'=>$types]);
    }
    // create new Type
    public function create_type(){
        return view('admin.types.add' , ['langs'=>$this->langs]);
    }


    public function store_type(TypesRequest $request){

        try{
            DB::beginTransaction();
            $type = new Types();
            $type->small_des = $request->small_des;
            
            foreach ($this->langs as $lang) {
                $type->{'name:'.$lang->code}   = $request->name[$lang->code];
                $type->{'des:'.$lang->code}    = $request->des[$lang->code];
            }
            // Save the model
            $type->save();
            // commit transaction
            DB::commit();
            Alert::success('Success', 'Type Added Successfully !');
            return redirect()->route('admin.types.index');
        }catch(\Exception $e){
           dd($e->getMessage() , $e->getLine());
            // If an exception occurs, rollback the transaction
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.types.index');
        }// end catach

        

    } // end store type

    // edit type
    public function edit_type($id){
        return view('admin.types.edit' , ['type'=>Types::findOrFail($id) , 'langs'=>$this->langs]);
    }

    public function update_type(TypesRequest $request ,  $id){
        
        try{
            DB::beginTransaction();
            $type = Types::findOrFail($id);
            $type->small_des = $request->small_des;
            foreach ($this->langs as $lang) {
                $type->{'name:'.$lang->code}   = $request->name[$lang->code];
                $type->{'des:'.$lang->code}    = $request->des[$lang->code];
            }
            // Save the model
            $type->save();
            // commit transaction
            DB::commit();
            Alert::success('Success', 'Type Updated Successfully !');
            return redirect()->route('admin.types.index');
        }catch(\Exception $e){  

            // If an exception occurs, rollback the transaction
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.types.index');
        }// end catach


    } // end update type

    public function delete_type($id){
        $type = Types::findOrFail($id);
        $type->delete();
        Alert::success('Success', 'Type Deleted Successfully !');
        return redirect()->route('admin.types.index');
    }

    public function show_options($id){
        $type = Types::with('options')->findOrFail($id);
        return view('admin.types.show_options' , ['type'=>$type]);
        
    }




    // start type option ============================= type option ================== 
    public function create_option(){
        return view('admin.types.type_option.add' , [ 'langs'=>$this->langs , 'types'=> Types::all() ]);
    }

    public function store_option(TypeOptionRequest $request){

        
       try{

        if($request->default == '1'){
            $check_if_has_default = Typeoption::where('type_id' , $request->type_id)->where('default' , '1')->first();
            if(isset($check_if_has_default)){
                Alert::error('error', 'Already Has Default option');
                return redirect()->route('admin.types.index');
            }
        }

        if($request->default == '0'){
            if(!isset($request->price)){
                Alert::error('error', 'Must Add Price');
                return redirect()->route('admin.types.index');
            }
        }

        DB::beginTransaction();
        $optionl = new Typeoption();
        $optionl->type_id = $request->type_id;
        $optionl->default = $request->default;
        $request->default == '0' ? $optionl->price = $request->price : $optionl->price = 0;
        foreach ($this->langs as $lang) {
            $optionl->{'name:'.$lang->code}   = $request->name[$lang->code];
            $optionl->{'des:'.$lang->code}    = $request->des[$lang->code];
        }
        // Save the model
        $optionl->save();
        DB::commit();
        Alert::success('Success', 'Type Updated Successfully !');
        return redirect()->route('admin.types.index');
       }catch(\Exception $e){
        dd($e->getMessage() , $e->getLine());
        // If an exception occurs, rollback the transaction
        DB::rollBack();
        Alert::error('error', 'Tell The Programmer To solve Error');
        return redirect()->route('admin.types.index');
       }


    } // end store oprional function 

    public function delete_option($id){
        $optionl = Typeoption::findOrFail($id);
        $optionl->delete();
        Alert::success('Success', 'Option Deleted Successfully !');
        return redirect()->back();
    } // end delete option



     

}
