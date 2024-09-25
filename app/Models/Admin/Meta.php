<?php

namespace App\Models\Admin;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
class Meta extends Model implements TranslatableContract
{
    use HasFactory , Translatable;
    public $translatedAttributes = ['meta_keywords', 'meta_tags' , 'meta_des' , 'meta_title'];
    protected $fillable = ['author' , 'website_name' , 'website_des'];
}
