<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\Admin\Lang;
use App\Models\Admin\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class SettingController extends Controller
{
    private $langs;
    private $files = [
        'logo' , 'favicon','home_breadcrumb_background','contact_breadcrumb_background',
        'about_breadcrumb_background','products_breadcrumb_background',
        'categories_breadcrumb_background','services_breadcrumb_background',
        'our_work_breadcrumb_background' , 'blog_breadcrumb_background' ,
        'blog_details_breadcrumb_background' , 'category_details_breadcrumb_background',
        'service_details_breadcrumb_background'
    ];
    public function __construct()
    {
        $this->langs = Lang::all();
    }

    //
    public function index()
    {
        $settings = Setting::first();
        return view('admin.settings.index' , ['settings' => $settings , 'langs'=> $this->langs]);

    }

    public function update(UpdateSettingRequest $request)
    {


      
        try {
            DB::beginTransaction();
             $setting = Setting::first();
            if($setting){
                $setting->finish = '1';
                $setting->slider = $request->slider;
                $setting->media = $request->media;
                $setting->cms = $request->cms;
                $setting->services = $request->services;
                $setting->products = $request->products;
                $setting->categories = $request->categories;
                $setting->our_works = $request->our_works;
                $setting->clients = $request->clients;
                $setting->social_media = $request->social_media;
                $setting->about_us = $request->about_us;
                $setting->contact_us = $request->contact_us;
                $setting->des = $request->des;
                $setting->achievement = $request->achievement;
                $setting->messages = $request->messages;   
                $setting->mission_vission = $request->mission_vission;  
                $setting->payments = $request->payments; 
                $setting->faq = $request->faq; 
                $setting->feedback = $request->feedback;
                $setting->offers = $request->offers;
                $setting->carts = $request->carts;
                $setting->city_price  = $request->city_price;
                $setting->orders      = $request->orders;
                $setting->points      = $request->points;
                $setting->coupons     = $request->coupons;
                $setting->types       = $request->types;
                $setting->extras      = $request->extras;
                $setting->combos      = $request->combos;
                $setting->branches    = $request->branches;
               foreach ($this->files as $file){
                  $image_name = $this->uploadFile($request , $file);
                   if($image_name){
                       if ( isset($setting) && ( $setting->{$file} != null ) && file_exists(public_path('uploads/images/setting/' . $setting->{$file})) ) {
                           unlink(public_path('uploads/images/setting/' .$setting->{$file}));
                       }// if already has file
                       $setting->{$file} = $image_name;
                       $setting->save();
                   } //check if is an image and was uploaded

               } // end foreach

                // lang upload multi lang input
                foreach ($this->langs as $lang) {
                    $setting->{'website_name:'.$lang->code}  = $request->website_name[$lang->code];
                    $setting->{'website_des:'.$lang->code}  = $request->website_des[$lang->code];
                    if(isset($request->working_hours[$lang->code])){
                          $setting->{'working_hours:'.$lang->code}  = $request->working_hours[$lang->code];
                    }

                }
                $setting->save();
                DB::commit();
                Alert::success('Success', 'Settings Updated Successfully ! !');
                return redirect()->route('admin.settings.index');

            }// if setting true

            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.settings.index');
        }catch (\Exception $e){
            dd($e->getMessage() , $e->getLine());
            // If an exception occurs, rollback the transaction
            DB::rollBack();
            Alert::error('error', 'Tell The Programmer To solve Error');
            return redirect()->route('admin.settings.index');
        }

    }

    protected function uploadFile($request , $file)
    {
        if($request->has($file)){
            $image_name = $request->{$file}->getClientOriginalName();
            $v = $request->{$file}->move(public_path('uploads/images/setting'), $image_name);;
            return $image_name;

        } // check if has file

        return false;
    }




}
