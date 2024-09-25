<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Governorate extends Model implements  TranslatableContract
{
    use HasFactory , Translatable;
    protected $fillable = ['code' , 'checked'];
    public $translatedAttributes = ['des', 'name' , 'small_des'];
    public $translationForeignKey = 'governorate_id';
    public $translationModel = 'App\Models\Admin\GovernorateTranslation';

    public function cities(){
        return $this->hasMany(citiy::class , 'governorate_id');
    }
}
