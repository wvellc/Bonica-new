<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Size;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug','code', 'flag','currency','symbol', 'rate', 'shipping_charge', 'created_at', 'updated_at'];

    public static function AllCountry()
    {
        return Country::pluck('name', 'id')->toArray();
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'size_countries', 'country_id', 'size_id');
    }
}
