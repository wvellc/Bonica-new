<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Metal extends Model
{
    use HasFactory, Sluggable;
    protected $fillable = ['name','slug','bgcolor', 'sort_order', 'status', 'created_at', 'updated_at'];

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
        return $query->where('metals.status', 1);
    }
    public function scopeInActive($query)
    {
        return $query->where('metals.status', 0);
    }
}
