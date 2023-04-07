<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Material;
use App\Models\Metal;

class ProductMetalMaterial extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'metal_id', 'material_id', 'price', 'created_at', 'updated_at'];

    public function metal()
    {
        return $this->belongsTo(Metal::class,'metal_id','id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class,'material_id','id');
    }

    public function metals()
    {
        return $this->belongsTo(Metal::class,'id');
    }

    public function materials()
    {
        return $this->belongsTo(Material::class,'id');

    }
    public static function getProductMetalMaterial($product_id, $metal_id, $material_id)
    {
        return self::where([['product_id',$product_id],['metal_id',$metal_id],['material_id',$material_id]])->value('price');
    }
}
