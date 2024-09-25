<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paymmob extends Model
{
    use HasFactory;
    protected $fillable = ['paymob_wallet_id' , 'paymob_card_id' , 'paymob_api' , 'paymob_card_iframe'];
}
