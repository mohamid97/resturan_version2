<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AllGovResource;
use App\Models\Admin\citiy;
use App\Models\Admin\Governorate;
use App\Trait\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
class GovController extends Controller
{
    use ResponseTrait;
    // get all govs
    public function all_gov(){
        $govs = Governorate::whereHas('translations', function ($query) {
            $query->where('locale', '=', app()->getLocale());
        })->where('checked' , '1')->get();

        return  $this->res(true ,'All Govs ' , 200 , AllGovResource::collection($govs));
    }

    public function all_city(Request $request){

        try{

            // Validate the request data
            $validatedData = $request->validate([
                'gov_id' => 'required|integer',
            ], [
                'gov_id.required' => 'Gov is required.',
                'gov_id.integer' => 'Gov must be a Integer.',

            ]);

            $city = citiy::whereHas('translations', function ($query) {
                $query->where('locale', '=', app()->getLocale());
            })->where('governorate_id' , $request->gov_id)->where('checked' , '1')->get();

         return  $this->res(true ,'All Cities ' , 200 , AllGovResource::collection($city));

        } catch (ValidationException $e) {
           // Handle validation exceptions
            return  $this->res(false , 'Validation failed: '  ,  422 ,   ['errors' => $e->errors()]);
           
       } catch (\Exception $e) {
           return  $this->res(false , 'An error occurred while getting cities. Please try again later. '  , $e->getCode() ,  ['errors' => $e->getMessage()]);
       }

    }


}
