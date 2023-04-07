<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use HasFactory, Sluggable;
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'slug', 'parent_id', 'image', 'banner_image', 'discover_image', 'shopthelook_image', 'discover_status', 'shopthelook_status', 'icon', 'meta_title', 'meta_keywords', 'meta_description', 'description', 'status', 'sort_order', 'created_at', 'updated_at'];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id', 'id');
    }
    public function limitedchildren()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->limit(6);
    }
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
    public function scopeActive($query)
    {
        return $query->where('categories.status', 1);
    }
    public function scopeInActive($query)
    {
        return $query->where('categories.status', 0);
    }
    public static function getChild($id)
    {

        return Category::where('parent_id', $id)->Active()->pluck('name', 'id')->toArray();
    }

    public static function getInfoById($id)
    {
        return self::where('id', $id)->first();
    }
}
