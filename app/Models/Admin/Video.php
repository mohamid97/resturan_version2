<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model implements  TranslatableContract
{
    use HasFactory , Translatable , SoftDeletes;
    use HasFactory , Translatable;
    protected $fillable = ['image' , 'link' , 'media_group_id'];
    public $translatedAttributes = ['des', 'name'];
    public $translationForeignKey = 'video_id';
    public $translationModel = 'App\Models\Admin\VideoTranslation';
}
