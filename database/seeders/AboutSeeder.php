<?php

namespace Database\Seeders;

use App\Models\Admin\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert dummy data into the users table
         DB::table('abouts')->insert([
            [
                'phone' => '023',
                'photo' => '1.jpg',
            ],

        ]);
        DB::table('about_translations')->insert([
            [
                'about_id' => About::first()->id,
                'locale'=>'ar',
                'des'=>'fdsfdsf',
                'name'=>'fdfdfd@f',
                'meta_title'=>'This is meta Title',
                'meta_des'=>'This is Meta des',
                'alt_image'=>'This is Meta des',
                'title_image'=>'This is Meta des'
            ],

        ]);

        DB::table('about_translations')->insert([
            [
                'about_id' => About::first()->id,
                'locale'=>'en',
                'des'=>'fdsfdsf',
                'name'=>'fdfdfd@f',
                'meta_title'=>'This is meta Title',
                'meta_des'=>'This is Meta des',
                'alt_image'=>'This is Meta des',
                'title_image'=>'This is Meta des'
            ],

        ]);

    }
}
