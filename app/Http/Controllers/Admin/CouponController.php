<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CouponsRequest;
use App\Http\Requests\Admin\UpdateCouponRequest;
use App\Models\Admin\Coupon;
use App\Models\Admin\Lang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;


class CouponController extends Controller
{
    public $langs;
    public function __construct()
    {
        $this->langs = Lang::all();
        
    }

    // index function return all coupons
    public function index(){
        $coupons = Coupon::withTrashed()->paginate(10);
        return view('admin.coupons.index' , ['coupons'=>$coupons]);
    }
    // add new coupon
    public function add(){
        return view('admin.coupons.add' , ['langs'=> $this->langs]);
    } // end add function redirect to add blade coupon

    public function edit($id){
      $coupon = Coupon::findOrFail($id);
      return view('admin.coupons.edit' , ['coupon'=>$coupon , 'langs'=>$this->langs]);
    }



    public function store(CouponsRequest $request){

       try{
            DB::beginTransaction();
            $image_name = null;
            if($request->has('photo')){
                $image_name = $request->photo->getClientOriginalName();
                $request->photo->move(public_path('uploads/images/coupons'), $image_name);
            }
            
            $startDate = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('start_date'))->format('Y-m-d H:i:s');
            $endDate = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('end_date'))->format('Y-m-d H:i:s');    
            $coupon = Coupon::create([
                'start_date' => $startDate,
                'end_date' => $endDate,
                'code' => Coupon::generateUniqueCode(),
                'percentage' => $request->input('percentage'),
                'image' => $image_name,
            ]);
            foreach ($this->langs as $lang) {
                $coupon->{'name:'.$lang->code}  = $request->name[$lang->code];
                $coupon->{'des:'.$lang->code}  = $request->des[$lang->code];
                $coupon->{'small_des:'.$lang->code}  = $request->small_des[$lang->code];
            }
            $coupon->save();
            DB::commit();
            Alert::success('Success', 'Coupon Added Successfully !');
            return redirect()->route('admin.coupons.index');
          

       }catch(\Exception $e){
            DB::rollBack();
            dd($e->getCode() , $e->getMessage());
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.coupons.index');


       }

    } // end store function 


    public function update(UpdateCouponRequest $request , $id){
        try{
            
            $coupon = Coupon::findOrFail($id);
 
            DB::beginTransaction();
            $image_name = null;
            if($request->has('photo')){
                $image_name = $request->photo->getClientOriginalName();
                $request->photo->move(public_path('uploads/images/coupon'), $image_name);
            }
            
            $startDate = Carbon::parse($request->input('start_date'))->format('Y-m-d H:i:s');
            $endDate = Carbon::parse($request->input('end_date'))->format('Y-m-d H:i:s');
          
            $coupon->update([
                'start_date' => $startDate,
                'end_date' => $endDate,
                'percentage' => $request->input('percentage'),
                'image' => isset($image_name) ? $image_name : $coupon->image,
            ]);
            foreach ($this->langs as $lang) {
                $coupon->{'name:'.$lang->code}  = $request->name[$lang->code];
                $coupon->{'des:'.$lang->code}  = $request->des[$lang->code];
                $coupon->{'small_des:'.$lang->code}  = $request->small_des[$lang->code];
            }
            $coupon->save();
            DB::commit();
            Alert::success('Success', 'Coupon Updated Successfully !');
            return redirect()->route('admin.coupons.index');
        }catch (\Exception $e){
            dd($e->getMessage() , $e->getLine());
            Alert::error('error', 'Tell The Programmer To solve Error');
            DB::rollBack();
            return redirect()->route('admin.coupons.index');
        }
    } // end update function 


    public function destroy($id)
    {
        $Coupon = Coupon::findOrFail($id);
        $Coupon->forceDelete();
        Alert::success('success', 'Coupon Deleted Successfully !');
        return redirect()->route('admin.coupons.index');
    }

    public function soft_delete($id)
    {
        $Coupon = Coupon::findOrFail($id);
        $Coupon->delete();
        Alert::success('success', 'Coupon Soft Deleted Successfully !');
        return redirect()->route('admin.coupons.index');

    }

    public function restore($id)
    {
        $Coupon = Coupon::withTrashed()->findOrFail($id);
        $Coupon->restore();
        Alert::success('success', 'Coupon Restored Successfully !');
        return redirect()->route('admin.coupons.index');

    }



}
