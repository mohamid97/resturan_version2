<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class Coupon extends Model
{
    use HasFactory , Translatable , SoftDeletes;
    protected $fillable = ['image' , 'code' , 'start_date' , 'end_date' , 'percentage'];
    public $translatedAttributes = ['des', 'name' , 'small_des'];
    public $translationForeignKey = 'coupon_id';
    public $translationModel = 'App\Models\Admin\CouponTranslation';

        public static function generateUniqueCode()
    {
        do {
            $code = Str::upper(Str::random(10)); // Generates a random 10 character code
        } while (self::where('code', $code)->exists());

        return $code;
    }
}
