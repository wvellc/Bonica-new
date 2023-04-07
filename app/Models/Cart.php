<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Size;
use App\Models\Color;
use App\Models\Clarity;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['product_id' ,'shape_id','metal_id', 'material_id', 'size_id','quantity' ,'ip_address','center_diamond_color_id','center_diamond_clarity_id','side_diamond_color_id','side_diamond_clarity_id', 'created_at', 'updated_at'];

    public function Product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id', 'id');
    }
    public function center_diamond_color()
    {
        return $this->belongsTo(Color::class,'center_diamond_color_id','id');
    }
    public function center_diamond_clarity()
    {
        return $this->belongsTo(Clarity::class,'center_diamond_clarity_id','id');
    }
    public function side_diamond_color()
    {
        return $this->belongsTo(Color::class,'side_diamond_color_id','id');
    }
    public function side_diamond_clarity()
    {
        return $this->belongsTo(Clarity::class,'side_diamond_clarity_id','id');
    }

}
