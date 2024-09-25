<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeoptionTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['name' , 'des'];
}
