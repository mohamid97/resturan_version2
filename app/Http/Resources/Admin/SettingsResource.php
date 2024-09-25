<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingsResource extends JsonResource
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

              'logo'                                     => $this->logo,
              'favicon'                                  => $this->favicon,
              'home_breadcrumb_background'               => $this->home_breadcrumb_background,
              'contact_breadcrumb_background'            => $this->contact_breadcrumb_background,
              'about_breadcrumb_background'              => $this->about_breadcrumb_background,
              'products_breadcrumb_background'           => $this->products_breadcrumb_background,
              'categories_breadcrumb_background'         => $this->categories_breadcrumb_background,
              'services_breadcrumb_background'           => $this->services_breadcrumb_background,
              'category_details_breadcrumb_background'   => $this->category_details_breadcrumb_background,
              'blog_details_breadcrumb_background'       => $this->blog_details_breadcrumb_background,
              'blog_breadcrumb_background'               => $this->blog_breadcrumb_background,
              'our_work_breadcrumb_background'           => $this->our_work_breadcrumb_background,
              'link_image'                               =>asset('/uploads/images/setting/'),
              'working_hours'                            => $this->working_hours,
              

        ];
    }
}
