<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Size;

class ProductSize extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'size_id', 'price_percentage', 'created_at', 'updated_at'];

    public function size()
    {
        return $this->belongsTo(Size::class,'size_id','id');
    }
}
