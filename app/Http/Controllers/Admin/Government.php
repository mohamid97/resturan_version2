<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\citiy;
use App\Models\Admin\CitiyPrice;
use App\Models\Admin\Governorate;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Government extends Controller
{
    //
    public function get(){

        $locale = app()->getLocale();

        $cities = citiy::with(['price', 'gov' => function ($query) use ($locale) {
                $query->whereHas('translations', function ($subQuery) use ($locale) {
                    $subQuery->where('locale', '=', $locale);
                });
            }])
            ->whereHas('translations', function ($query) use ($locale) {
                $query->where('locale', '=', $locale);
            })
            ->latest()
            ->paginate(10);

        return view('admin.city_price.index', ['cities'=>$cities]);
    }

    // edit price of city
    public function edit_price($id){
       $city = citiy::with('price')->findOrFail($id);
       return view('admin.city_price.edit', ['city'=>$city]);
    }

    // update price 
    public function update_price($id , Request $request){
       
        $request->validate([
            'price'=>'required'
        ]);
        try{
            $city = citiy::with(['gov' , 'price'])->findOrFail($id);
            $city_price = CitiyPrice::where('citiy_id' , $city->id)->first();
    
            if(isset($city_price)){
                $city_price->price = $request->price;
            }else{
                $city_price = new CitiyPrice();
                $city_price->governorate_id = $city->gov->id;
                $city_price->citiy_id       = $city->id;
                $city_price->price          =  $request->price;
                
            }
            $city_price->save();
            Alert::success('Success', 'Price Added Successfully !');
            return redirect()->route('admin.city_price.index');
        }catch(\Exception $e){
            Alert::success('error', 'Canot Update Price !');
            return redirect()->route('admin.city_price.index');
        }



    }


    public function check_gov(){
        $govs = Governorate::all();
        return view('admin.city_price.check_govs', ['govs'=>$govs]);

    }

    public function update_govs(Request $request){
        // Get the array of selected governorate IDs
        $selectedGovs = $request->input('govs', []);

        // Update the 'checked' column to 1 for the selected governorates
        Governorate::whereIn('id', $selectedGovs)->update(['checked' => '1']);

        // Optionally, update the 'checked' column to 0 for the unselected governorates
        Governorate::whereNotIn('id', $selectedGovs)->update(['checked' => '0']);

        return redirect()->route('admin.city_price.check_gov');
    }
    
    public function check_city(){
        $cities = citiy::whereHas('gov', function($query) {
            $query->where('checked', '1');
        })->get();

        return view('admin.city_price.check_city', ['cities'=>$cities]);

        

    }

    public function update_city(Request $request){
                $selectedGovs = $request->input('cities', []);
                // Update the 'checked' column to 1 for the selected governorates
                citiy::whereIn('id', $selectedGovs)->update(['checked' => '1']);
        
                // Optionally, update the 'checked' column to 0 for the unselected governorates
                citiy::whereNotIn('id', $selectedGovs)->update(['checked' => '0']);
        
                return redirect()->route('admin.city_price.check_city');
    }






}
