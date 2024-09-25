<?php

namespace App\Models\Admin;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CitiyPrice extends Model
{
    use HasFactory;

    public function city(){
        return $this->belongsTo(citiy::class , 'citiy_id');
    }

    public function gov(){
        return $this->belongsTo(Governorate::class , 'governorate_id');
    }
}
