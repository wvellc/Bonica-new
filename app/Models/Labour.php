<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Metal;
use App\Models\Material;

class Labour extends Model
{
    use HasFactory, Sluggable;
    protected $fillable = ['name','metal_id', 'material_id', 'price', 'status', 'created_at', 'updated_at'];
    public function sluggable() : array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function metal()
    {
        return $this->belongsTo(Metal::class,'metal_id','id');
    }
    public function material()
    {
        return $this->belongsTo(Material::class,'material_id','id');
    }

    public function scopeActive($query)
    {
        return $query->where('labours.status', 1);
    }
    public function scopeInActive($query)
    {
        return $query->where('labours.status', 0);
    }
}
