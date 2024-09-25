<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Service extends Model implements TranslatableContract
{
    use HasFactory , SoftDeletes , Translatable;
    public $translatedAttributes = ['name', 'des' , 'meta_title' , 'meta_des' , 'slug' , 'alt_image' , 'title_image'];
    protected $fillable = ['price' , 'star' , 'image'];
    public $translationForeignKey = 'service_id';
    public $translationModel = 'App\Models\Admin\ServiceTranslation';

    public function gallery()
    {
        return $this->hasMany(ServicesGallary::class , 'service_id');

    }
}
