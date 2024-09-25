<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ExtraRequest;
use App\Models\Admin\Extra;
use App\Models\Admin\Lang;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ExtraController extends Controller
{
    //
    protected $langs;
    public function __construct()
    {
        $this->langs = Lang::all();
        
    }


    // get extra 
    public function get(){
        return view('admin.extra.index' , ['extras'=>Extra::all()]);
    }

    // create function 
    public function create(){
        return view('admin.extra.create' , ['langs'=>$this->langs]);
    }
    
    // store function 
    public function store(ExtraRequest $request){

        try{
            DB::beginTransaction();
            $extra = new Extra();
            $extra->price = $request->price;
            foreach ($this->langs as $lang) {
                $extra->{'name:'.$lang->code}         = $request->name[$lang->code];
                $extra->{'des:'.$lang->code}          = $request->des[$lang->code];
            }
            $extra->save();
            DB::commit();
            Alert::success('Success', 'Extra Added Successfully !');
            return redirect()->route('admin.extra.index');
        }catch(Exception $e){
            // If an exception occurs, rollback the transaction
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.extra.index');

        }


    } // end store

    // edit function 
    public function edit($id){
        return view('admin.extra.edit' , ['langs'=>$this->langs , 'extra'=>Extra::findOrFail($id)]);
    }



    // update function 
    public function update(ExtraRequest $request , $id){
        try{
            
            DB::beginTransaction();
            $extra = Extra::findOrFail($id);
            $extra->price = $request->price;
            foreach ($this->langs as $lang) {
                $extra->{'name:'.$lang->code} = $request->name[$lang->code];
                $extra->{'des:'.$lang->code}  = $request->des[$lang->code];
            }
            $extra->save();
            DB::commit();
            Alert::success('Success', 'Extra Updated Successfully !');
            return redirect()->route('admin.extra.index');

        }catch(\Exception $e){

            // If an exception occurs, rollback the transaction
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.extra.index');

        }

    } //end update function 



    //delete
    public function delete($id){
        // get extra
        $extra = Extra::findOrFail($id);
        // delete
        $extra->delete();
        // Alert
        Alert::success('Success', 'Extra Deleted Successfully !');
        // redirect you index
        return redirect()->route('admin.extra.index');

    } 





}
