<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\OurClientResource;
use App\Models\Admin\OurClient;
use App\Trait\ResponseTrait;
use Illuminate\Http\Request;

class OurClientController extends Controller
{
    use ResponseTrait;
    //
    public function get()
    {
        $clients = OurClient::all();
        return  $this->res(true ,'All Clients' , 200 ,OurClientResource::collection($clients));

    }
}
