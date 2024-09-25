<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    use HasFactory;

    public function gov(){
        return $this->belongsTo(Governorate::class , 'gov_id');
    }

    public function city(){
        return $this->belongsTo(citiy::class , 'city_id');
    }
}
