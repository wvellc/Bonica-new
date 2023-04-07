<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Country;

class SizeCountry extends Model
{
    use HasFactory;
    protected $fillable = ['size_id','country_id','created_at', 'updated_at'];
}
