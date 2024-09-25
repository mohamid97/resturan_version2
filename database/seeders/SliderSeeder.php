<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SliderSeeder extends Seeder
{
    protected $slider;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 4; $i++) {
            $this->slider = DB::table('sliders')->insertGetId([
                'arrange' => $i,
                'image' => $i . '.jpg' // Include file extension in image name
            ]);

            DB::table('slider_translations')->insert([
                [
                    'slider_id' => $this->slider,
                    'locale' => 'ar',
                    'name' => 'السلايدر رقم ' . $i,
                    'alt_image' => 'تعريف الصوره رقم ' . $i,
                    'title_image' => 'title_image Number ' . $i,
                    'small_des' => 'وصف صغير للسلايدر رقم ' . $i,
                    'des' => ' وصف كبير للسلايدر رقم ' . $i,
                ],
            ]);

            DB::table('slider_translations')->insert([
                [
                    'slider_id' => $this->slider,
                    'locale' => 'en',
                    'name' => 'Slider Number ' . $i,
                    'alt_image' => 'alt_image Number ' . $i,
                    'title_image' => 'title_image Number ' . $i,
                    'small_des' => 'Small Description Number ' . $i,
                    'des' => 'Description Number This Is Descrption Number ' . $i,
                ],
            ]);
        }
    }
}
