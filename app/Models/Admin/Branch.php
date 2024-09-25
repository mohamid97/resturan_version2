<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Branch extends Model implements  TranslatableContract
{
    use HasFactory , Translatable;
    protected $fillable = ['status' , 'phone1' , 'phone2' , 'location'];
    public $translatedAttributes = ['des', 'name' , 'address'];
    public $translationForeignKey = 'branch_id';
    public $translationModel = 'App\Models\Admin\BranchTranslation';
}
