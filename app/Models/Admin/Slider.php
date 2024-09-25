<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Slider extends Model implements TranslatableContract
{
    use HasFactory , Translatable , SoftDeletes;

    public $translatedAttributes = ['name' , 'alt_image' , 'title_image' ,'small_des' , 'des'];
    public $translationForeignKey = 'slider_id';
    public $translationModel = 'App\Models\Admin\SliderTranslation';
}
