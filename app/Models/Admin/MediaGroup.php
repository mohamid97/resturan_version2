<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Psy\CodeCleaner\FunctionContextPass;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class MediaGroup extends Model
{

    use HasFactory , Translatable , SoftDeletes;
    protected $fillable = ['image'];
    public $translatedAttributes = ['title', 'small_des' , 'des' , 'alt_image', 'title_image' ];
    public $translationForeignKey = 'media_group_id';
    public $translationModel = 'App\Models\Admin\MediaGroupTranslation';
    use HasFactory , SoftDeletes;


    public function gallerys(){
        return $this->hasMany(GalleryImage::class , 'media_group_id');
    }

    public function files(){
        return $this->hasMany(File::class , 'media_group_id');
    }

    public function viedos(){
        return $this->hasMany(Video::class , 'media_group_id');
    }






}
