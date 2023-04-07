<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\BlogCategory;
use App\Models\Admin;

class Blog extends Model
{
    use HasFactory ,Sluggable;

    protected $fillable = ['title','image','slug', 'content', 'category_id','status','created_by','meta_title', 'meta_keywords', 'meta_description','created_at', 'updated_at'];
    public function sluggable() : array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function scopeActive($query)
    {
        return $query->where('blogs.status', 1);
    }
    public function scopeInActive($query)
    {
        return $query->where('blogs.status', 0);
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class,'category_id','id')->select(array('id','name'));
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class,'created_by','id')->select(array('id','name'));
    }
}
