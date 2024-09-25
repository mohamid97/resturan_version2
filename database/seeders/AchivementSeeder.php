<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AchivementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('achievements')->insert([
            [
                'years_exp' => '5',
                'number_of_clients'=>500,
                'number_of_deps'=>500,
                'number_of_products'=>500,
                'number_of_emps'=>500,
                'num1'=>500,
                'num2'=>500,
                'num3'=>500,
                'num4'=>500,
            ],

        ]);
    }
}
