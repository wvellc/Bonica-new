<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class OurStory extends Model
{
    use HasFactory,Sluggable;

    protected $fillable = ['name', 'slug','content', 'status', 'created_at', 'updated_at'];
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
        return $query->where('our_stories.status', 1);
    }
    public function scopeInActive($query)
    {
        return $query->where('our_stories.status', 0);
    }
}
