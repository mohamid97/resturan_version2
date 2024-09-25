<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointsPrice extends Model
{
    use HasFactory;
    protected $fillable = ['num_points' , 'num_pounds' , 'order_amount' , 'order_points'];
}
