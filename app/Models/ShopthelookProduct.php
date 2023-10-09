<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopthelookProduct extends Model
{
    use HasFactory;
    protected $fillable = ['category_id','product_id','created_at', 'updated_at'];

    public static function getSelectedProduct($cat_id)
    {
        $shopthelookProduct = ShopthelookProduct::where('category_id',$cat_id)->get()->toArray();
        $product = array();
        if(!empty($shopthelookProduct)){
            foreach($shopthelookProduct as $value ){
                $product[] = $value['product_id'];
            }
        }
        return $product;
    }

    public function product()
    {
        return $this->hasMany(Product::class,'id','product_id');
    }
}
