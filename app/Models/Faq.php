<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\CategoryFaq;

class Faq extends Model
{
    use HasFactory, Sluggable;
    protected $fillable = ['question','slug','answer','status', 'created_at', 'updated_at'];

    public function sluggable() : array
    {
        return [
            'slug' => [
                'source' => 'question'
            ]
        ];
    }
    public function topics()
    {
        return $this->belongsTo(CategoryFaq::class,'cate_id','id')->select(array('id','topic'));
    }
    public function scopeActive($query)
    {
        return $query->where('faqs.status', 1);
    }
    public function scopeInActive($query)
    {
        return $query->where('faqs.status', 0);
    }
}
