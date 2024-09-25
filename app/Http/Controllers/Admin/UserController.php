<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EditUserRequest;
use App\Models\Admin\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    //
    public function index()
    {
        $accounts = User::withTrashed()->where('type' , 'user')->get();
        return view('admin.users.index' , compact('accounts'));

    }



    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit' , compact('user'));

    }


    public function update(EditUserRequest $request , $id)
    {
        try {

            DB::beginTransaction();
            $user = User::findOrFail($id);
            $user->update([
                'first_name' =>$request->first_name,
                'last_name'  =>$request->last_name,
                'email'      =>$request->email,
                'phone'      => $request->phone,
            ]);

            if($request->has('avatar')){
                $image_name = $request->avatar->getClientOriginalName();
                $request->avatar->move(public_path('uploads/images/users'), $image_name);
                if ($user->avatar != null && file_exists(public_path('uploads/images/users/' .$user->avatar))) {
                    unlink(public_path('uploads/images/users/' .$user->avatar));
                }
                $user->avatar = $image_name;
                $user->save();

            }
            DB::commit();
            Alert::success('success', 'User Updated Successfully !');
            return redirect()->route('admin.users.index');

        }catch (\Exception $e){
           dd($e->getLine() , $e->getMessage());
           DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.users.index');
        }

    } // end update user


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->forceDelete();
        Alert::success('success', 'User Deleted Successfully !');
        return redirect()->route('admin.users.index');
    }

    public function soft_delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        Alert::success('success', 'User Soft Deleted Successfully !');
        return redirect()->route('admin.users.index');

    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();
        Alert::success('success', 'Users Restored Successfully !');
        return redirect()->route('admin.users.index');

    }

}
