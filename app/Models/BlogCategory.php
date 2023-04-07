<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Blog;

class BlogCategory extends Model
{
    use HasFactory, Sluggable;
    protected $fillable = ['name','slug','status','created_at', 'updated_at'];

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
        return $query->where('blog_categories.status', 1);
    }
    public function scopeInActive($query)
    {
        return $query->where('blog_categories.status', 0);
    }
    public function blogs()
    {
        return $this->hasMany(Blog::class,'category_id')->Active();
    }
}
