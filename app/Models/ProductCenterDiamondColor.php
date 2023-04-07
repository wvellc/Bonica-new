<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCenterDiamondColor extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','color_id', 'created_at', 'updated_at'];
}
