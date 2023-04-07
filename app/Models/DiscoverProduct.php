<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class DiscoverProduct extends Model
{
    use HasFactory;
    protected $fillable = ['category_id','product_id','created_at', 'updated_at'];

    public static function getSelectedProduct($cat_id)
    {
        /* $discoverProduct = DiscoverProduct::with('product')->where('category_id',$cat_id)->get()->toArray();
        dd($discoverProduct); */
        $discoverProduct = DiscoverProduct::where('category_id',$cat_id)->get()->toArray();
        //dd($discoverProduct);
        $product = array();
        if(!empty($discoverProduct)){
            foreach($discoverProduct as $value ){
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
