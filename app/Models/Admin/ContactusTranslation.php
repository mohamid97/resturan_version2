<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactusTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['des', 'address'];

}
