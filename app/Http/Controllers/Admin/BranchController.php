<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BranchRequest;
use App\Models\Admin\Branch;
use App\Models\Admin\Lang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class BranchController extends Controller
{
    protected $langs;

    public function __construct()
    {
        $this->langs = Lang::all();
        
    }
    // index
    public function index(){
        return view('admin.branches.index' , [ 'branchs' => Branch::all()]);
    }

    public function edit($id){
        $branch =  Branch::findOrFail($id);
        return view('admin.branches.edit' , ['langs'=>$this->langs , 'branch'=>$branch]);
    }

    public function create(){

        return view('admin.branches.create' , ['langs'=>$this->langs]);

    }

    public function store(BranchRequest $request){
       
        try{
            DB::beginTransaction();
            $branch = new Branch();
            isset($request->location) ? $branch->location = $request->location : '';
            isset($request->phone1) ? $branch->phone1 = $request->phone1 : '';
            isset($request->phone2) ? $branch->phone2 = $request->phone2 :'';
            isset($request->whatsup) ? $branch->whatsup = $request->whatsup : '';
            foreach ($this->langs as $lang) {
                $branch->{'name:'.$lang->code}         = $request->name[$lang->code];
                $branch->{'des:'.$lang->code}          = $request->des[$lang->code];
                $branch->{'address:'.$lang->code}      = $request->address[$lang->code];

            }
            $branch->save();
            DB::commit();
            Alert::success('Success', 'Branch Added Sucessfully !');
            return redirect()->route('admin.branches.index');
        }catch(\Exception $e){
           
           DB::rollBack();
           Alert::error('error', 'Error Happened!');
           return redirect()->route('admin.branches.index');
        }

    }
    
    public function update(BranchRequest $request , $id){
        try{
            DB::beginTransaction();
            $branch =  Branch::findOrFail($id);
            isset($request->location) ? $branch->location = $request->location : '';
            isset($request->phone1) ? $branch->phone1 = $request->phone1 : '';
            isset($request->phone2) ? $branch->phone2 = $request->phone2 :'';
            isset($request->whatsup) ? $branch->whatsup = $request->whatsup : '';
            foreach ($this->langs as $lang) {
                $branch->{'name:'.$lang->code}         = $request->name[$lang->code];
                $branch->{'des:'.$lang->code}          = $request->des[$lang->code];
                $branch->{'address:'.$lang->code}      = $request->address[$lang->code];
            }
            $branch->save();
            DB::commit();
            Alert::success('Success', 'Branch Updated Sucessfully !');
            return redirect()->route('admin.branches.index');
            DB::commit();
        }catch(\Exception $e){
            
            DB::rollBack();
            Alert::error('error', 'Error Happened!');
            return redirect()->route('admin.branches.index');
        }
    }

    public function destroy($id){
        $branch =  Branch::findOrFail($id);
        $branch->delete();
        Alert::success('Success', 'Branch Deleted Sucessfully !');
        return redirect()->route('admin.branches.index');

    }





}
