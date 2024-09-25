<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model implements  TranslatableContract
{
    use HasFactory , Translatable , SoftDeletes;
    protected $fillable = ['icon' , 'image'];
    public $translatedAttributes = ['des', 'name' , 'small_des'];
    public $translationForeignKey = 'feedback_id';
    public $translationModel = 'App\Models\Admin\FeedbackTranslation';
}
