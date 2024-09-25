<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('social_media')->insert([
            [
                'facebook'         => 'https://www.facebook.com/',
                'facebook_option' => 'on',
                'twitter' => 'https://www.twitter.com/',
                'twitter_option' => 'on',
                'skype' => 'https://www.skype.com/',
                'skype_option' => 'on',
                'instagram' => 'https://www.instagram.com/',
                'instagram_option' => 'on',
                'tiktok' => 'https://www.tiktok.com/',
                'tiktok_option' => 'on',
                'youtube' => 'https://www.youtube.com/',
                'youtube_option' => 'on',
                'snapchat' => 'https://www.snapchat.com/',
                'snapchat_option' => 'on',
                'linkedin' => 'https://www.linkedin.com/',
                'linkedin_option' => 'https://www.linkedin.com/',
                'whatsup' => '+201564556',
                'whatsup' => 'on',
                'phone' => '+20851854',
                'phone_option' => 'on',

            ],

        ]);
    }
}
