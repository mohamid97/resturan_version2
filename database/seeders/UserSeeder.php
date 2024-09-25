<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'first_name' => 'CanGrow',
                'last_name'=>'Company',
                'avatar'=>'1.jpg',
                'phone'=>'+2011545454',
                'email'=>'canGrow@gmail.com',
                'type'=>'admin',
                'password'=>Hash::make('123456')
            ],

        ]);
    }
}
