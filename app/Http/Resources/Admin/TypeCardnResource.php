<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\OptionsResource;
use App\Models\Admin\Typeoption;
use Illuminate\Http\Resources\Json\JsonResource;

class TypeCardnResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $option = Typeoption::where('type_id' , $this->id)->first();
        return [
            'name'=>$this->name,
            'des'=>$this->des,
            'small_des'=>$this->small_des,
            'type'=>new OptionsResource($option)
            
        ];
    }
}
