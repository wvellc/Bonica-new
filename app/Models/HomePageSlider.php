<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePageSlider extends Model
{
    use HasFactory;
    protected $fillable = ['slider_type', 'video','video_path', 'status', 'created_at', 'updated_at'];
}
