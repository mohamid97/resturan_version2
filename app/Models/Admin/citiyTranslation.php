<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class citiyTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['des', 'name' , 'small_des'];
}
