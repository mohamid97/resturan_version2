<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Typeoption extends Model implements  TranslatableContract
{
    use HasFactory , Translatable;
    protected $fillable = ['default'];
    public $translatedAttributes = ['des', 'name'];
    public $translationForeignKey = 'type_option_id';
    public $translationModel = 'App\Models\Admin\TypeoptionTranslation';
}
