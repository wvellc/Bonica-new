<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Faq;

class CategoryFaq extends Model
{
    use HasFactory, Sluggable;
    protected $fillable = ['topic','slug','icon','status','created_at', 'updated_at'];
    public function sluggable() : array
    {
        return [
            'slug' => [
                'source' => 'topic'
            ]
        ];
    }
    public function scopeActive($query)
    {
        return $query->where('category_faqs.status', 1);
    }
    public function scopeInActive($query)
    {
        return $query->where('category_faqs.status', 0);
    }

    public function topics()
    {
        return $this->hasMany(Faq::class,'cate_id')->Active();
    }
}
