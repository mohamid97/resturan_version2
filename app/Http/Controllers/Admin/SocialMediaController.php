<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SocialRequest;
use App\Models\Admin\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class SocialMediaController extends Controller
{
    //
    public function index()
    {
        $social = SocialMedia::first();
        return view('admin.social.index' , compact('social'));
    }
    public function update(Request $request , $id)
    {
        try {
            DB::beginTransaction();
            $social = SocialMedia::findOrFail($id);
            $social->facebook = $request->facebook;
            $social->facebook_option = $request->facebook_option;
            $social->twitter = $request->twitter;
            $social->twitter_option = $request->twitter_option;
            $social->instagram = $request->instagram;
            $social->instagram_option = $request->instagram_option;
            $social->tiktok = $request->tiktok;
            $social->tiktok_option = $request->tiktok_option;
            $social->youtube = $request->youtube;
            $social->youtube_option = $request->youtube_option;
            $social->snapchat = $request->snapchat;
            $social->snapchat_option = $request->snapchat_option;
            $social->whatsup = $request->whatsup;
            $social->whatsup_option = $request->whatsup_option;
            $social->linkedin = $request->linkedin;
            $social->linkedin_option = $request->linkedin_option;
            $social->email = $request->email;
            $social->email_option = $request->email_option;
            $social->phone = $request->phone;
            $social->phone_option = $request->phone_option;
            $social->skype = $request->skype;
            $social->skype_option = $request->skype_option;
            $social->save();
            DB::commit();
            Alert::success('Success', 'Updated Successfully ! !');
            return redirect()->route('admin.social_media.index');
        }catch (\Exception $e){
         DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.social_media.index');
        }

    }
}
