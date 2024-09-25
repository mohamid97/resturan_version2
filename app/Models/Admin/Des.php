<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Des extends Model implements  TranslatableContract
{
    use HasFactory , Translatable , SoftDeletes;
    protected $fillable = ['type' , 'image'];
    public $translatedAttributes = ['des', 'name' , 'alt_image' , 'title_image'];
    public $translationForeignKey = 'des_id';
    public $translationModel = 'App\Models\Admin\DesTranslation';
}
