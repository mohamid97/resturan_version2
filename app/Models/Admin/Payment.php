<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Payment extends Model implements TranslatableContract
{
    use HasFactory , Translatable;
    protected $fillable = ['slug' , 'stauts'];
    public $translatedAttributes = ['name', 'des'];
    public $translationForeignKey = 'payment_is';
    public $translationModel = 'App\Models\Admin\PaymentTranslation';
}
