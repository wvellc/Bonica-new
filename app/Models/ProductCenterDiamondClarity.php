<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCenterDiamondClarity extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','clarity_id', 'created_at', 'updated_at'];
}
