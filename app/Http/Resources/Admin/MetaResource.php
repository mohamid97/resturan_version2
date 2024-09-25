<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class MetaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
 
       return[
            'meta_title'=>$this->meta_title,
            'meta_keywords' => $this->meta_keywords,
            'meta_tags' => $this->meta_tags,
            'meta_des'  => $this->meta_des

       ];
    }
}
