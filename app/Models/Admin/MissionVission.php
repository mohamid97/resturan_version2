<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class MissionVission extends Model implements  TranslatableContract
{
    use HasFactory, Translatable;
    protected $fillable = ['status'];
    public $translatedAttributes = ['services', 'mission' , 'vission', 'breif' , 'about'];
    public $translationForeignKey = 'mission_vission_id';
    public $translationModel = 'App\Models\Admin\MissionVissionTranslate';
}
