<?php

namespace App\Models\Admin;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Translatable;

class GalleryImage extends Model implements TranslatableContract
{
    use HasFactory ,Translatable ,  SoftDeletes;
    public $translatedAttributes = [ 'name' , 'alt_image' , 'title_image'];
    protected $fillable = ['photo' , 'media_group_id'];
    public $translationForeignKey = 'image_id';
    public $translationModel = 'App\Models\Admin\GalleryImageTranslation';

}
