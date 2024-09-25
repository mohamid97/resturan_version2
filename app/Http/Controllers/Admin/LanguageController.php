<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLangRequest;
use App\Models\Admin\Lang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use RealRashid\SweetAlert\Facades\Alert;


class LanguageController extends Controller
{
    //
    public function index()
    {
        $langs = Lang::all();
        return view('admin.lang.index' , compact('langs'));

    }

    public function create()
    {
        $langs =  LaravelLocalization::getSupportedLocales();
        return view('admin.lang.add' , compact('langs'));

    }

    public function store(StoreLangRequest $request)
    {

        try {
            DB::beginTransaction();
            $langs = LaravelLocalization::getSupportedLocales();
            if (array_key_exists($request->lang, $langs)) {
                $lang = $langs[$request->lang];

                $is_lang = Lang::where('code' , $request->lang)->first();
                if($is_lang != null){
                    Alert::error('error', 'Lang Is Already Exists !');
                    return redirect()->route('admin.lang.index');
                }
                Lang::create([
                    'name'=> $lang['name'],
                    'code'=>$request->lang
                ]);
                DB::commit();
                Alert::success('Success', 'Lang Added Successfully ! !');
                return redirect()->route('admin.lang.index');
            }


            Alert::error('error', 'Lang does not Exist');
            return redirect()->route('admin.lang.index');
        }catch (\Exception $e){
            dd($e->getLine() , $e->getMessage());
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.lang.index');
        }

    }


    public function delete($id)
    {
        $lang = Lang::findOrFail($id);
        $lang->delete();
        Alert::success('Success', 'Lang Deleted Successfully ! !');
        return redirect()->route('admin.lang.index');
    }
}
