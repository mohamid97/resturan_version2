<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PointsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('points_prices')->insertGetId([
            'num_points' => 10,
            'order_points' => 100,
            'order_amount'=>'1',
            'num_pounds'=>'1',
        ]);
    }
}
