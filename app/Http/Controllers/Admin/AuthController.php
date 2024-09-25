<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    //
    public function show_login(){
        return view('admin.auth.login');
    }

    public function show_update()
    {
        $user = User::where('type' , 'admin')->first();
        return view('admin.auth.update' , ['user'=>$user]);

    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);


        $user = User::where([
            ['email', '=', $request->email],
            ['type', '=', 'admin'],
        ])->first();

        if(isset($user) && $user != null){
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials, $request->remember)) {
                return redirect()->route('admin.index');
            }
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('showLogin');
    }

    public function update(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = User::where('type' , 'admin')->first();

        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->save();
        Alert::success('Success', 'Your Info Changed!');
        return redirect()->route('admin.auth.showUpdate');

    }




}
