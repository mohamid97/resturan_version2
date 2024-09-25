<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model implements TranslatableContract
{
    use HasFactory , Translatable , SoftDeletes;

    public $translatedAttributes = ['des', 'name'];
    protected $fillable = ['file' , 'media_group_id'];
    public $translationForeignKey = 'file_id';
    public $translationModel = 'App\Models\Admin\FileTranslation';
}
