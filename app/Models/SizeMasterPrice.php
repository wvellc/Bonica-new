<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Size;
use App\Models\Country;

class SizeMasterPrice extends Model
{
    use HasFactory;

    protected $fillable = ['min_size','min_value','max_size','max_value','price','category_id' ,'status', 'created_at', 'updated_at'];

}
