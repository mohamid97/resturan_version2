<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
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
            'name'=>$this->name,
            'address'=>$this->address,
            'address2'=>$this->address2,
            'email'=>$this->email,
            'des'=>$this->des,
            'image'=>$this->image,
            'alt_image'=>$this->alt_image,
            'title_image'=>$this->title_image,
            'meta_title' => $this->meta_title,
            'meta_des'=>$this->meta_des,
            'phone1'=>$this->phone1,
            'phone2'=>$this->phone2,
            'phone3'=>$this->phone3,
            'photo'=>$this->photo,
            'link_image'=>asset('/uploads/images/contactus/')
        ];
    }
}
