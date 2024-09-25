<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    protected $category;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 8; $i++) {
            $this->category = DB::table('categories')->insertGetId([
                'type' => '0',
                'photo' => $i . '.jpg', // Include file extension in image name
                'star' =>null
            ]);

            DB::table('category_translations')->insert([
                [
                    'category_id' => $this->category,
                    'locale' => 'ar',
                    'name' => 'القسم رقم  رقم ' . $i,
                    'alt_image' => 'تعريف الصوره رقم ' . $i,
                    'title_image' => 'title_image Number ' . $i,
                    'small_des' => 'وصف صغير للقسم رقم ' . $i,
                    'des' => ' وصف كبير للقسم  رقم ' . $i,
                    'slug' =>'اسم تعريفي للقسم'
                ],
            ]);

            DB::table('category_translations')->insert([
                [
                    'category_id' => $this->category,
                    'locale' => 'en',
                    'name' => 'Category Number ' . $i,
                    'alt_image' => 'alt_image Number ' . $i,
                    'title_image' => 'title_image Number ' . $i,
                    'small_des' => 'Small Description Number ' . $i,
                    'des' => 'Description Number This Is Descrption Number ' . $i,
                    'slug' =>'Category Slug Number ' .$i
                ],
            ]);
        }
    }
}
