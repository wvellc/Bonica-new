<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePageSliderImage extends Model
{
    use HasFactory;
    protected $fillable = ['image','image_path', 'sort_order', 'status', 'created_at', 'updated_at'];

    public function scopeActive($query)
    {
        return $query->where('home_page_slider_images.status', 1);
    }
    public function scopeInActive($query)
    {
        return $query->where('home_page_slider_images.status', 0);
    }
}
