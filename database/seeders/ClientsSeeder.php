<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 6; $i++) {
          DB::table('our_clients')->insert([
                'name' => 'client number' . $i,
                'address' =>'address client',
                'icon'   =>  $i . '.jpg' // Include file extension in image name
            ]);

        }
    }
}
