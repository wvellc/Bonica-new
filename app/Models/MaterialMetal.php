<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Metal;
use App\Models\Material;

class MaterialMetal extends Model
{
    use HasFactory;
    protected $fillable = ['metal_id', 'material_id', 'price', 'created_at', 'updated_at'];

    public function metal()
    {
        return $this->belongsTo(Metal::class,'metal_id','id')->select(array('id','name'));
    }

    public function material()
    {
        return $this->belongsTo(Material::class,'material_id','id')->select(array('id','name'));
    }
}
