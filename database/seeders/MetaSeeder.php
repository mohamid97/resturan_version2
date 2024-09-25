<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetaSeeder extends Seeder
{
    protected $meta;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
            $this->meta = DB::table('metas')->insertGetId([
                'website_name' => 'dssd',
                'website_des' => 'dssd',
                'author' => 'canGrow' // Include file extension in image name
            ]);

            DB::table('meta_translations')->insert([
                [
                    'slider_id' => $this->meta,
                    'locale' => 'ar',
                    'meta_keywords'=>'dsdsds',
                    'meta_tags'=>'fdfdfd',
                    'meta_title'=>'fsdfsdfsdf',
                    'meta_de'=>'fdsfsdfds'
                ],
            ]);

            DB::table('meta_translations')->insert([
                [
                    'slider_id' => $this->meta,
                    'locale' => 'en',
                    'meta_keywords'=>'dsdsds',
                    'meta_tags'=>'fdfdfd',
                    'meta_title'=>'fsdfsdfsdf',
                    'meta_de'=>'fdsfsdfds',

                ],
            ]);


    }

}
