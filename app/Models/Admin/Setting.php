<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Setting extends Model implements TranslatableContract
{
    use HasFactory , Translatable;
    public $translatedAttributes = ['website_name', 'website_des' ,'working_hours'];
    protected $fillable = ['logo','favicon','faq','blog_breadcrumb_background' ,'service_details_breadcrumb_background','category_details_breadcrumb_background' , 'blog_details_breadcrumb_background','our_work_breadcrumb_background','home_breadcrumb_background' , 'contact_breadcrumb_background' , 'about_breadcrumb_background' , 'products_breadcrumb_background' , 'categories_breadcrumb_background' , 'services_breadcrumb_background'];
    public $translationForeignKey = 'setting_id';
    public $translationModel = 'App\Models\Admin\SettingTranslation';
}
