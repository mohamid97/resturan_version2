<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Types extends Model implements  TranslatableContract
{

    use HasFactory , Translatable;
    protected $fillable = ['small_des'];
    public $translatedAttributes = ['name' , 'des'];
    public $translationForeignKey = 'type_id';
    public $translationModel = 'App\Models\Admin\TypeTranslation';

    public function options(){
        return $this->hasMany(Typeoption::class , 'type_id');
    }


    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_types', 'type_id', 'product_id');
    }
    
}
