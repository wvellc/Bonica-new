<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail;
use App\Models\Country;

class Order extends Model
{
    use HasFactory;

    public function OrderDetail()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function countryDetals()
    {
        return $this->belongsTo(Country::class,'country','id');
    }
}
