<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Shape;
use App\Models\Color;
use App\Models\Clarity;

class Packet extends Model
{
    use HasFactory, Sluggable;
    protected $fillable = ['name','diamond_size', 'shape_id','color_id','clarity_id', 'price', 'status', 'created_at', 'updated_at'];
    public function sluggable() : array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function shape()
    {
        return $this->belongsTo(Shape::class,'shape_id','id');
    }
    public function color()
    {
        return $this->belongsTo(Color::class,'color_id','id');
    }
    public function clarity()
    {
        return $this->belongsTo(Clarity::class,'clarity_id','id');
    }

    public function scopeActive($query)
    {
        return $query->where('packets.status', 1);
    }
    public function scopeInActive($query)
    {
        return $query->where('packets.status', 0);
    }
}
