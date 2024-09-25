<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class CouponsResource extends JsonResource
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
            'des'=>$this->des,
            'small_des'=>$this->small_des,
            'percentage'=>$this->percentage,
            'image'     =>$this->image,
            'image_path'=>asset('uploads/images/coupons'),
            'code'=>$this->code,
            'start_date'=>$this->start_date,
            'end_date'=>$this->end_date
        ];

    }
}
