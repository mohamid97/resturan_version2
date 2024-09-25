<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;


class MetaServices extends Model implements  TranslatableContract
{
    use HasFactory , Translatable;
    protected $fillable = ['type'];
    public $translatedAttributes = ['meta_keywords', 'meta_tags' , 'meta_des' , 'meta_title'];
    public $translationForeignKey = 'meta_service_id';
    public $translationModel = 'App\Models\Admin\MetaServicesTranslation';
}
