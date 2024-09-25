<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Combo extends Model implements  TranslatableContract
{
    use HasFactory , Translatable;
    protected $fillable = ['photo' , 'price'];
    public $translatedAttributes = ['des', 'name'];
    public $translationForeignKey = 'combo_id';
    public $translationModel = 'App\Models\Admin\ComboTranslation';



    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_comobs', 'combo_id', 'product_id');
    }


    


}
