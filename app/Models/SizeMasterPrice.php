<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Size;
use App\Models\Country;

class SizeMasterPrice extends Model
{
    use HasFactory;

    protected $fillable = ['size_id','price','country_id', 'status', 'created_at', 'updated_at'];

    public function size()
    {
        return $this->belongsTo(Size::class,'size_id','id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }
}
