<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Address extends Model implements  TranslatableContract
{
    use HasFactory ,Translatable;
    protected $fillable = ['gov_id' , 'city_id'];
    public $translatedAttributes = ['address'];
    public $translationForeignKey = 'address_id';
    public $translationModel = 'App\Models\Admin\AddressTranslation';

    public function gov(){
        return $this->belongsTo(Governorate::class , 'gov_id');
    }
    public function city(){
        return $this->belongsTo(citiy::class , 'city_id');
    }
    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }
}
