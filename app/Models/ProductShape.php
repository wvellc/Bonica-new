<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shape;

class ProductShape extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'shape_id', 'price', 'created_at', 'updated_at'];

    public function shape()
    {
        return $this->belongsTo(Shape::class,'shape_id','id');
    }
    public function shapes()
    {
        return $this->belongsTo(Shape::class,'id');
    }
    public static function getProductShapePrice($product_id, $shape_id)
    {
        return self::where([['product_id',$product_id],['shape_id',$shape_id]])->value('price');
    }
}
