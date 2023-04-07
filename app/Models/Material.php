<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Material extends Model
{
    use HasFactory, Sluggable;
    protected $fillable = ['name','slug', 'sort_order', 'status', 'created_at', 'updated_at'];

    public function sluggable() : array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('materials.status', 1);
    }
    public function scopeInActive($query)
    {
        return $query->where('materials.status', 0);
    }
}
