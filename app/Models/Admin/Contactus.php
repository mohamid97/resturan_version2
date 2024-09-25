<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Contactus extends Model implements TranslatableContract
{
    use HasFactory , Translatable;

    protected $fillable = ['email' , 'phone1' , 'phone2' , 'phone3' , 'photo'];

    public $translatedAttributes = ['des', 'address' , 'address2', 'name' , 'meta_title' , 'meta_des' ,'title_image' , 'alt_image'];
    public $translationForeignKey = 'contact_id';
    public $translationModel = 'App\Models\Admin\ContactusTranslation';
}
