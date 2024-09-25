<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Translatable;

class Cms extends Model implements TranslatableContract
{
    use HasFactory , Translatable ,  SoftDeletes;
    public $translatedAttributes = ['des', 'name' , 'small_des' ,'meta_des' , 'meta_title' , 'alt_image' , 'title_image' , 'slug'];
    protected $fillable = ['status' , 'image'];
    public $translationForeignKey = 'cms_id';
    public $translationModel = 'App\Models\Admin\CmsTranslation';

}
