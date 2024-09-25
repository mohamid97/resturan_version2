<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\Statistics;
use App\Trait\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    use ResponseTrait;
    //
    public function save(Request $request){
     
        try{

          DB::beginTransaction();
          $request->validate([
            'longitude' =>'required',
            'latitude'  =>'required',
            'ip'        =>'required',
            'type'      =>'required',
            'id'        =>'required'
        ]);

        // statistics
        $statistics = new Statistics();
        $statistics->ip = $request->ip;
        $statistics->longtude = $request->longitude;
        $statistics->latitude  = $request->latitude;
        $statistics->type      = $request->type;
        $statistics->type_id   = $request->id;
        $statistics->save();
        DB::commit();
        return  $this->res(true ,'Successfully Added !' , 200);

        }catch(\Exception $e){

            DB::rollBack();
            return  $this->res(false ,'Error Happend' , $e->getCode() , $e->getMessage());        

        }



    }
}
