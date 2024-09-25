<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class About extends Model implements  TranslatableContract
{
    use HasFactory , Translatable;
    protected $fillable = ['image' , 'phone'];
    public $translatedAttributes = ['des', 'name' , 'meta_title', 'meta_des' , 'title_image' , 'alt_image'];
    public $translationForeignKey = 'about_id';
    public $translationModel = 'App\Models\Admin\AboutTranslation';
}
