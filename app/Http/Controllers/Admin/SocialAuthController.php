<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;


class SocialAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    
    }


    public function handleGoogleCallback()
    {
       $user_data = Socialite::driver('google')->user();
 
               // Check if user already exists using google_id
        $existingUser = User::where('google_id', $user_data->id)->first();
        if (isset($existingUser)) {
                $token = $existingUser->createToken('auth_token')->plainTextToken;
                return redirect()->to('https://restaurant-template-sooty.vercel.app/login/redirect?token=' . $token);
        } else {
                // Create a new user
                $user = new User();
                $user->first_name = $user_data->user['given_name'];
                $user->last_name  = $user_data->user['family_name'];
                $user->password   = Hash::make('123456');
                $user->email      = $user_data->user['email'];
                $user->phone      = null;
                $user->google_id = $user_data->id;
                $user->type       = 'user';
                $user->avatar     = null; // Assign the image name or null if no image
                $user->save();
                // Generate a personal access token
                $token = $user->createToken('auth_token')->plainTextToken;
                return redirect()->to('https://restaurant-template-sooty.vercel.app/login/redirect?token=' . $token);
        }

       
    }

}
