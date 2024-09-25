<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;
    protected $fillable = ['years_exp' , 'number_of_clients' , 'number_of_deps' , 'number_of_products' , 'number_of_emps' , 'num1' , 'num2' , 'num3','num4'];
}
