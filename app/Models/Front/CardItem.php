<?php

namespace App\Models\Front;

use App\Models\Admin\Extra;
use App\Models\Admin\Product;
use App\Models\Admin\Typeoption;
use App\Models\Admin\Types;
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

    public function types()
    {
        return $this->belongsToMany(Types::class, 'cart_items_types', 'card_item_id', 'type_id');
    }

    public function options()
    {
        return $this->belongsToMany(Typeoption::class, 'cart_items_types', 'card_item_id' , 'typeoption_id');
    }

    public function extras()
    {
        return $this->belongsToMany(Extra::class, 'cart_items_extras', 'card_item_id', 'extra_id');
    }


}
