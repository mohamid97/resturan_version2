<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Contactus;
use App\Models\Admin\Lang;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ContactusRequest;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ContactUsController extends Controller
{
    private $langs;

    public function __construct()
    {
        $this->langs = Lang::all();
    }

    // index function
    public function index()
    {
        $contactus = Contactus::first();
        return view('admin.contactus.index' , ['contactus'=> $contactus , 'langs'=> $this->langs]);

    }

    // update contact us
    public function update(ContactusRequest $request , $id)
    {
        try {
            DB::beginTransaction();
            $contact = Contactus::first();
            if($request->has('photo')){
                $image_name = $request->photo->getClientOriginalName();
                $request->photo->move(public_path('uploads/images/contactus'), $image_name);
                if (isset($contact->photo) && file_exists(public_path('uploads/images/contactus/' .$contact->photo))) {
                    unlink(public_path('uploads/images/contactus/' .$contact->photo));
                }
                $contact->photo = $image_name;
            }
            $contact->phone1 = isset($request->phone1)?$request->phone1:null;
            $contact->phone2 = isset($request->phone2)?$request->phone2:null;
            $contact->phone3 = isset($request->phone3)?$request->phone3:null;
            foreach ($this->langs as $lang) {
                $contact->{'address:'.$lang->code}  = $request->address[$lang->code];
                $contact->{'address2:'.$lang->code}  = $request->address2[$lang->code];
                $contact->{'des:'.$lang->code}  = $request->des[$lang->code];
                $contact->{'name:'.$lang->code}  = $request->name[$lang->code];
                $contact->{'meta_des:'.$lang->code}  = $request->meta_des[$lang->code];
                $contact->{'meta_title:'.$lang->code}  = $request->meta_title[$lang->code];
                $contact->{'title_image:'.$lang->code}  = $request->title_image[$lang->code];
                $contact->{'alt_image:'.$lang->code}  = $request->alt_image[$lang->code];
            }
            $contact->save();
            DB::commit();
            Alert::success('Success', 'Contact Us Updated Successfully ! !');
            return redirect()->route('admin.contact.index');
        }catch(\Exception $e){
            dd($e->getLine() , $e->getMessage());
            // If an exception occurs, rollback the transaction
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.contact.index');
        }

    }





}
