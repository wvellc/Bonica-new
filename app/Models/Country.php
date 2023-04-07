<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug','code', 'flag','currency','symbol', 'rate', 'shipping_charge', 'created_at', 'updated_at'];

    public static function AllCountry()
    {
        return Country::pluck('name', 'id')->toArray();
    }
}
