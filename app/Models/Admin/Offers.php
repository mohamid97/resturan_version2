<?php

namespace App\Models\Admin;

use App\Models\OffersProducts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offers extends Model implements  TranslatableContract
{
    use HasFactory , Translatable , SoftDeletes;
    protected $fillable = ['old_price' , 'price' , 'image'];
    public $translatedAttributes = ['title', 'small_des', 'des'];
    public $translationForeignKey = 'offers_id';
    public $translationModel = 'App\Models\Admin\OffersTranslation';


    public function offer_products(){
        return $this->hasMany(OffersProducts::class , 'offers_id');
    }
}
