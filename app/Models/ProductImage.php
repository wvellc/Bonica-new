<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'shape_id', 'metal_id','metal_display_priority_id','image','image_path','video_path','video_type','sort_order','type', 'created_at', 'updated_at'];
}
