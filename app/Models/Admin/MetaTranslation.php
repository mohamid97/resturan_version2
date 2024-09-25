<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['meta_keywords', 'meta_tags' , 'meta_des'];
}
