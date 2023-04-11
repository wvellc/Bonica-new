<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Color extends Model
{
    use HasFactory, Sluggable;
    protected $fillable = ['name', 'slug', 'status', 'created_at', 'updated_at'];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('colors.status', 1);
    }
    public function scopeInActive($query)
    {
        return $query->where('colors.status', 0);
    }
}
