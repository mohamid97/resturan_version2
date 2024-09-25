<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Models\Admin\Message;
use App\Trait\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class MessageController extends Controller
{
    use  ResponseTrait;
    //

    public function index()
    {
        $messages = Message::all();
        return view('admin.messages.index' , ['msgs' => $messages]);
    }

    public function show($id)
    {
        try {
            $msg = Message::findOrFail($id);
            return view('admin.messages.show' , ['msg'=>$msg]);

        }catch(\Exception $e){
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.messages.index');
        }

    }

    public function destroy($id)
    {
        $slider = Message::findOrFail($id);
        $slider->delete();
        Alert::success('success', 'Message Deleted Successfully !');
        return redirect()->route('admin.messages.index');

    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone'=>'nullable',
            'message'=>'required|string|max:2024'
        ]);

        if ($validator->fails()) {
            // Return validation errors as JSON response
            return $this->res(false , 'Error !' , 422 , ['errors' => $validator->errors()]);

        }

        try{
           $msg =  Message::create($request->only('name' , 'email' , 'phone','message'));
            return $this->res(true , 'Message Created Successfully !' , 200 , $msg);
        }catch (\Exception $e){
            return $this->res(false , 'Error !' , 400 , [$e->getMessage() , $e->getLine()]);
        }


    }
}
