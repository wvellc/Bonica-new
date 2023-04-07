<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    public function scopeActive($query)
    {
        return $query->where('testimonials.status', 1);
    }
    public function scopeInActive($query)
    {
        return $query->where('testimonials.status', 0);
    }
}
