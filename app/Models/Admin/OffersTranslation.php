<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffersTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'small_des' , 'des'];
}
