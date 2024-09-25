<?php

namespace Database\Seeders;

use App\Models\Admin\About;
use App\Models\Admin\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'logo' => '1.jpg',
                'favicon'=>'2.jpg',
                'home_breadcrumb_background'=>'1.jpg',
                'contact_breadcrumb_background'=>'1.jpg',
                'about_breadcrumb_background'=>'1.jpg',
                'products_breadcrumb_background'=>'2.jpg',
                'categories_breadcrumb_background'=>'3.jpg',
                'services_breadcrumb_background'=>'4.jpg',
                'our_work_breadcrumb_background'=>'4.jpg',
                'finish'=>'0',
            ],

        ]);

        DB::table('setting_translations')->insert([
            [
                'setting_id' => Setting::first()->id,
                'locale'=>'ar',
                'website_des'=>'fdsfdsf',
                'website_name'=>'اسم الموقع',
            ],

        ]);


        
        DB::table('setting_translations')->insert([
            [
                'setting_id' => Setting::first()->id,
                'locale'=>'en',
                'website_des'=>'fdsfdsf',
                'website_name'=>'web site name',
            ],

        ]);
    }
}
