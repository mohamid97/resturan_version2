<?php

namespace Database\Seeders;

use App\Models\Admin\MissionVission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MissionVissionSeeder extends Seeder
{
    private $mission;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('mission_vissions')->insertGetId([
            'status' => '1',
        ]);

        $this->mission = MissionVission::first();

        DB::table('mission_vission_translates')->insertGetId([
            'mission_vission_id'=> $this->mission->id,
            'locale' => 'en',
            'services'=>' This Is Services With English',
            'about' => 'This  is About with English ',
            'mission' => 'This  Is Mission English ',
            'vission' => 'This is vission From English',
            'breif'   => ' This Is Breif  From English',

        ]);


        DB::table('mission_vission_translates')->insertGetId([
            'mission_vission_id'=> $this->mission->id,
            'locale' => 'ar',
            'services'=>' This Is Services With arabic',
            'about' => 'This  is About with arabic ',
            'mission' => 'This  Is Mission arabic ',
            'vission' => 'This is vission From arabic',
            'breif'   => ' This Is Breif  From arabic',

        ]);

    }
}
