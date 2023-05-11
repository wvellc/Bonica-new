<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\ProductShape;
use App\Models\ProductMetalMaterial;
use App\Models\ProductSize;

class Product extends Model
{
    use HasFactory,Sluggable;
    protected $fillable = ['cat_id', 'sub_cat_id','labour_type','is_solitaire','other_expenses', 'name', 'slug','is_sales','sales_price','price','gender','metal_display_priority_id','is_all_include_price','short_description','description' ,'quantity' ,'sku', 'made_in', 'resizable','diamonds','stone','igi_certified','recommended','color','clarity','gold_weight','diamond_weight','net_weight','diamond_pcs','status','meta_title', 'meta_keywords', 'meta_description', 'created_at', 'updated_at'];
    public function sluggable() : array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    /*Product Active & Inactive*/
    public function scopeActive($query)
    {
        return $query->where('products.status', 1);
    }
    public function scopeInActive($query)
    {
        return $query->where('products.status', 0);
    }

    /*Category And Sub Category*/
    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id', 'id');
    }
    public function subcategory()
    {
        return $this->belongsTo(Category::class, 'sub_cat_id', 'id');
    }

    /*Get First Product Shape*/
    public function firstProductShape()
    {
        return $this->hasOne(ProductShape::class, 'product_id');
    }

    public function ProductShapes()
    {
        return $this->hasMany(ProductShape::class, 'product_id');
    }

    /*Get First Product Metal & Material*/
    public function firstProductMetalMaterial()
    {
        return $this->hasOne(ProductMetalMaterial::class, 'product_id');
    }

    /*Get Metal & Material With Product*/
    public function ProductMetalMaterial()
    {
        return $this->hasMany(ProductMetalMaterial::class, 'product_id');
    }

    /*Get Size With Product*/
    public function ProductSize()
    {
        return $this->hasMany(ProductSize::class, 'product_id');
    }

    /*Get Prodcts Images*/
    public function productImages()
    {
        return $this->hasMany(ProductImage::class,'product_id')->orderBy('sort_order', 'ASC');
    }
    /*Get Single Prodcts Images*/
    public function singleProductImages()
    {
        return $this->hasOne(ProductImage::class,'product_id')->orderBy('sort_order', 'ASC');
    }
    public static function getProductPrice($product_id)
    {
        return self::where([['id',$product_id]])->value('price');
    }
    public static function getProductSalesPrice($product_id)
    {
        return self::where([['id',$product_id]])->value('sales_price');
    }
}
