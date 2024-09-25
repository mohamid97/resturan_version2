<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Faq extends Model implements TranslatableContract
{
    use HasFactory , Translatable , SoftDeletes;
    protected $fillable = ['image'];
    public $translatedAttributes = ['des', 'title' , 'alt_image' , 'title_image' , 'question','answer'];
    public $translationForeignKey = 'faq_id';
    public $translationModel = 'App\Models\Admin\FaqTranslation';
}
