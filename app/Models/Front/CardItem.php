<?php

namespace App\Models\Front;

use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardItem extends Model
{
    protected $fillable = [];
    use HasFactory;

    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


}
