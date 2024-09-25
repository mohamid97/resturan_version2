<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackTranslation extends Model
{
    protected $fillable = ['des', 'name' , 'small_des'];
    use HasFactory;
}
