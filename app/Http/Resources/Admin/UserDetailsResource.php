<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class UserDetailsResource extends JsonResource
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
            'first_name'     =>$this->first_name,
            'last_name'      =>$this->last_name,
            'Complete Name'  =>$this->first_name . ' ' .$this->last_name,
            'avatar'         =>$this->avatar,
            'avatar_link'    =>asset('/uploads/images/users/'),
            'phone'          =>$this->phone,
            'email'          =>$this->email,
            'points'         =>$this->points,
            'points_pound'   =>$this->points_pound,
            'type'           =>$this->type
            

        ];
    }
}
