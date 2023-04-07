<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class sizeGuide extends Model
{
    use HasFactory,Sluggable;

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
        return $query->where('size_guides.status', 1);
    }
    public function scopeInActive($query)
    {
        return $query->where('size_guides.status', 0);
    }
}
