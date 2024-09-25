<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectsSeeder extends Seeder
{
    protected $project;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 8; $i++) {
            $this->project = DB::table('ourworks')->insertGetId([
                'icon' => $i . '.jpg', // Include file extension in image name
                'photo' => $i . '.jpg', // Include file extension in image name
                'link' => 'fgdfd fdf dfd',

            ]);

            DB::table('ourwork_translations')->insert([
                [
                    'ourwork_id' => $this->project,
                    'locale' => 'ar',
                    'name' => 'المشروع رقم ' . $i,
                    'alt_image' => 'تعريف الصوره رقم ' . $i,
                    'title_image' => 'title_image Number ' . $i,
                    'meta_des' => 'وصف صغير للمشروع رقم ' . $i,
                    'meta_title' => 'وصف صغير للمشروع رقم ' . $i,
                    'des' => ' وصف كبير للمشروع رقم ' . $i,
                ],
            ]);

            DB::table('ourwork_translations')->insert([
                [
                    'ourwork_id' => $this->project,
                    'locale' => 'en',
                    'name' => 'المشروع رقم ' . $i,
                    'alt_image' => 'تعريف الصوره رقم ' . $i,
                    'title_image' => 'title_image Number ' . $i,
                    'meta_des' => 'وصف صغير للمشروع رقم ' . $i,
                    'meta_title' => 'وصف صغير للمشروع رقم ' . $i,
                    'des' => ' وصف كبير للمشروع رقم ' . $i,
                ],
            ]);
        }
    }
}
