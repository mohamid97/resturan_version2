<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferCard extends Model
{
    use HasFactory;

    public function offer(){
        return  $this->belongsTo(Offers::class , 'offer_id');
    }

    public function user(){
        return  $this->belongsTo(User::class , 'user_id');
    }
}
