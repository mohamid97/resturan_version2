<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;


class Category extends Model implements TranslatableContract
{
    use HasFactory ,Translatable, SoftDeletes;

    public $translatedAttributes = ['des', 'name' , 'small_des' , 'alt_image' , 'title_image' , 'slug' , 'meta_des' , 'meta_title'];
    protected $fillable = ['type' , 'parent_id' , 'star'];
    public $translationForeignKey = 'category_id';
    public $translationModel = 'App\Models\Admin\CategoryTranslation';


    public function services()
    {
        return $this->hasMany(Service::class , 'category_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class , 'category_id');
    }

    public function childs(){
        return $this->hasMany(Category::class , 'parent_id');
    }
}
