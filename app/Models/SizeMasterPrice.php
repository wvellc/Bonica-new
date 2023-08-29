<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Size;
use App\Models\Country;

class SizeMasterPrice extends Model
{
    use HasFactory;

    protected $fillable = ['min_size','max_size','price', 'status', 'created_at', 'updated_at'];

}
