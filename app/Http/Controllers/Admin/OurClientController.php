<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EditOurClientRequest;
use App\Http\Requests\Admin\OurClientRequest;
use App\Models\Admin\OurClient;
use App\Models\Admin\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class OurClientController extends Controller
{
    public function index()
    {
        $clients = OurClient::withTrashed()->get();
        return view('admin.clients.index' ,compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.add');

    }

    public function edit($id)
    {
        $client = OurClient::findOrFail($id);
        return view('admin.clients.edit' , compact('client'));

    }

    public function store (OurClientRequest $request)
    {

        try{
            DB::beginTransaction();
            if($request->has('icon')){
                $image_name = $request->icon->getClientOriginalName();
                $request->icon->move(public_path('uploads/images/clients'), $image_name);
            }

            OurClient::create(['name'=>$request->name ,'address'=>$request->address , 'icon'=>$image_name]);
            DB::commit();
            Alert::success('Success', 'Added Successfully !');
            return redirect()->route('admin.our_clients.index');

        }catch(\Exception $e){
   
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.our_clients.index');
        }

    }

    public function update(EditOurClientRequest $request , $id)
    {
        try{
            DB::beginTransaction();
            $client = OurClient::findOrFail($id);
            $client->update($request->only(['name' ,'address']));
            if($request->has('icon')){
                $image_name = $request->icon->getClientOriginalName();
                $request->icon->move(public_path('uploads/images/clients'), $image_name);
                if (isset($client->icon) && file_exists(public_path('uploads/images/clients/' .$client->icon))) {
                    unlink(public_path('uploads/images/clients/' .$client->icon));
                }

                $client->icon = $image_name;
                $client->save();
            }

            DB::commit();
            Alert::success('Success', 'Updated Successfully ! !');
            return redirect()->route('admin.our_clients.index');

        }catch(\Exception $e){
            // If an exception occurs, rollback the transaction
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.our_clients.index');
        }


    }



    public function destroy($id)
    {
        $client = OurClient::findOrFail($id);
        $client->forceDelete();
        Alert::success('success', 'OurClient  Deleted Successfully !');
        return redirect()->route('admin.our_clients.index');
    }

    public function soft_delete($id)
    {
        $client = OurClient::findOrFail($id);
        $client->delete();
        Alert::success('success', 'OurClientSoft Deleted Successfully !');
        return redirect()->route('admin.our_clients.index');

    }

    public function restore($id)
    {
        $client = OurClient::withTrashed()->findOrFail($id);
        $client->restore();
        Alert::success('success', 'Our Client Restored Successfully !');
        return redirect()->route('admin.our_clients.index');

    }
}
