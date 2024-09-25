<?php

namespace Database\Seeders;

use App\Models\Admin\Contactus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contactuses')->insert([
            [
                
                'email' => 'canGrow@gmail.com',
                'phone1' =>'+20124545568',
                'phone2' =>'+20124545563',
                'phone3' =>'+20124545468',
            ],

        ]);

        DB::table('contactus_translations')->insert([
            [
                'contact_id' => Contactus::first()->id,
                'locale'=>'ar',
                'des'=>'fdsfds',
                'meta_title'=>'fdsfds',
                'meta_des'=>'fdsfds',
                'name'=>'fdsfds',
                'alt_image'=>'This is Meta des',
                'title_image'=>'This is Meta des'
            ],

        ]);


    }
}
