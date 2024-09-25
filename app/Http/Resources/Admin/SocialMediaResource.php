<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class SocialMediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
           'facebook'     =>['link'=>$this->facebook , 'option'=>($this->facebook_option != null) ? 'On' : 'Off'],
           'twitter'      =>['link'=>$this->twitter , 'option'=>($this->twitter_option != null) ? 'On' : 'Off'],
           'linkedin'      =>['link'=>$this->linkedin , 'option'=>($this->linkedin_option != null) ? 'On' : 'Off'],
           'instagram'    =>['link'=>$this->instagram , 'option'=>($this->instagram_option != null) ? 'On' : 'Off'],
           'tiktok'       =>['link'=>$this->tiktok , 'option'=>($this->tiktok_option != null) ? 'On' : 'Off'],
           'youtube'      =>['link'=>$this->youtube	 , 'option'=>($this->youtube_option != null) ? 'On' : 'Off'],
           'snapchat'     =>['link'=>$this->snapchat	 , 'option'=>($this->snapchat_option != null) ? 'On' : 'Off'],
           'whatsup'      =>['link'=>$this->snapchat	 , 'option'=>($this->whatsup_option != null) ? 'On' : 'Off'],
           'skype'      =>['link'=>$this->skype	 , 'option'=>($this->skype_option != null) ? 'On' : 'Off'],
           'email'      =>['link'=>$this->email	 , 'option'=>($this->email_option != null) ? 'On' : 'Off'],
           'phone'      =>['link'=>$this->phone	 , 'option'=>($this->phone_option != null) ? 'On' : 'Off'],


        ];
    }
}
