<?php

namespace App\Http\Resources\Admin;

use App\Models\Admin\MediaGroup;
use Illuminate\Http\Resources\Json\JsonResource;
use Psy\CodeCleaner\AssignThisVariablePass;

class OurworkResource extends JsonResource
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
            'photo'=>asset('/uploads/images/ourworks/' . $this->photo),
            'meta_title'=>$this->meta_title,
            'meta_des'=>$this->meta_des,
            'alt_image'=>$this->alt_image,
            'title_image'=>$this->title_image,
            'icon'=>asset('/uploads/images/ourworks/' . $this->icon),
            'link'=>$this->link,
            'media'=>new MediaGroupResource(MediaGroup::with(['gallerys' ,'files' , 'viedos' ])->find($this->media_id)),
        ];

        

    }
}
