<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin\SocialMedia;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AboutSeeder::class);
        $this->call(ContactusSeeder::class);
        $this->call(LangSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(SocialMediaSeeder::class);
        $this->call(AchivementSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(CmsSeeder::class);
        $this->call(ClientsSeeder::class);
        $this->call(ServicesSeeder::class);
        $this->call(SescriptionSeeder::class);
        $this->call(ProjectsSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(MissionVissionSeeder::class);
        $this->call(GovernorateSeeder::class);
        $this->call(citiySeeder::class);
        $this->call(PointsSeeder::class);
    }

    
}
