<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Achievement;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AchievementConroller extends Controller
{
    //
    public function index()
    {
        $achieve = Achievement::first();
        return view('admin.achieve.index' , ['achieve'=>$achieve]);

    }

    public function update(Request $request)
    {
        $achievement = Achievement::first();
        $achievement->update([
            'years_exp' => $request->input('years_exp'),
            'number_of_clients' => $request->input('number_of_clients'),
            'number_of_deps' => $request->input('number_of_deps'),
            'number_of_products' => $request->input('number_of_products'),
            'number_of_emps' => $request->input('number_of_emps'),
            'num1' => $request->input('num1'),
            'num2' => $request->input('num2'),
            'num3' => $request->input('num3'),
            'num4' => $request->input('num4'),
        ]);
        Alert::success('success', 'Achievement Updated Successfully !');
        return redirect()->route('admin.ach.index');

    }
}
