<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Country;

class Size extends Model
{
    use HasFactory;
    protected $fillable = ['name','price', 'sort_order', 'status', 'created_at', 'updated_at'];

    public static function AllSize()
    {
        return Size::pluck('name', 'id')->toArray();
    }

    public function scopeActive($query)
    {
        return $query->where('sizes.status', 1);
    }
    public function scopeInActive($query)
    {
        return $query->where('sizes.status', 0);
    }

    public function country()
    {
        return $this->belongsToMany(Country::class,'size_countries', 'size_id', 'country_id');
    }
}
