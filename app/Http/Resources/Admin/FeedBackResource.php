<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class FeedBackResource extends JsonResource
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
            'name'=> $this->name,
            'image'=>$this->image,
            'icon' =>$this->icon,
            'des'=>$this->des,
            'small_des'=>$this->small_des,
            'image_path'=> asset('uploads/images/feedbacks')
        ];
    }
}
