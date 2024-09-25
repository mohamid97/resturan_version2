<?php

namespace App\Models\Front;

use App\Models\Admin\DeliveryStatus;
use App\Models\Admin\OrderAddress;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }


    public function delivery()
    {      
        return $this->hasOne(DeliveryStatus::class , 'order_id');
    }

    public function address(){
        return $this->hasOne(OrderAddress::class , 'order_id');
    }


}
