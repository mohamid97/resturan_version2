<?php

namespace App\Models\Admin;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class citiy extends Model implements  TranslatableContract
{
    use HasFactory , Translatable;
    protected $fillable = ['code'];
    public $translatedAttributes = ['des', 'name' , 'small_des'];
    public $translationForeignKey = 'citiy_id';
    public $translationModel = 'App\Models\Admin\citiyTranslation';

    public function gov(){
        return $this->belongsTo(Governorate::class , 'governorate_id');
    }

    public function price(){
        return $this->hasOne(CitiyPrice::class , 'citiy_id');
    }
}
