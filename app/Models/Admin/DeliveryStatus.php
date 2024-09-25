<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryStatus extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_id',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }
}
