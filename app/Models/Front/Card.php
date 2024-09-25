<?php

namespace App\Models\Front;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    
    public function items()
    {
        return $this->hasMany(CardItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }
}
