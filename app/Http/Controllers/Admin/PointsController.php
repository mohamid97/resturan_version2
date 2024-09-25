<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\PointsPrice;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PointsController extends Controller
{

    // get price of points 
    public function get(){
        return view('admin.points.points_price' ,['point'=>PointsPrice::first()] );
    }
    // update points price
    public function update_price(Request $request){
   
        $request->validate([
            'points'=>'required|integer',
            'order_points'=>'required|integer',
            'pounds'=>'required|integer',
            'order_amount'=>'required|integer',
        ]);
       
            // Define the values to update or create with
        $values = [
            'num_points' => $request->input('points'),
            'num_pounds' => $request->input('pounds'),
            'order_points'=>$request->input('order_points'),
            'order_amount'=>$request->input('order_amount')
        ];
        PointsPrice::updateOrCreate([], $values);
        Alert::success('success', 'Points Price Updated Successfully!');
        return redirect()->route('admin.points.index');
    } // end update price function 



}
