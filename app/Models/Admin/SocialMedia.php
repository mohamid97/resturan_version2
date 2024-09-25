<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;
    protected $fillable = [
        'facebook',
        'facebook_option',
        'twitter',
        'twitter_option',
        'instagram',
        'instagram_option',
        'tiktok',
        'tiktok_option',
        'youtube',
        'youtube_option',
        'snapchat',
        'snapchat_option',
        'whatsup',
        'whatsup_option',
        'linkedin',
        'linkedin_option',
        'email',
        'email_option',
        'phone',
        'phone_option',
    ];
}
