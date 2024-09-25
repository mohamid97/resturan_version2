<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Extra extends Model implements  TranslatableContract
{
    use HasFactory , Translatable;
    protected $fillable = ['price' ];
    public $translatedAttributes = ['des', 'name'];
    public $translationForeignKey = 'extra_id';
    public $translationModel = 'App\Models\Admin\ExtraTranslation';


    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_extras', 'extra_id', 'product_id');
    }
}
