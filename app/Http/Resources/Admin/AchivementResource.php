<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class AchivementResource extends JsonResource
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
            'exp_years' => $this->years_exp,
            'clients'   => $this->number_of_clients,
            'deps'      => $this->number_of_deps,
            'products'  => $this->number_of_products,
            'emps'      => $this->number_of_emps,
            'num1'      => $this->num1,
            'num2'      => $this->num2,
            'num3'      => $this->num3,
            'num4'      => $this->num4
        ];
    }
}
