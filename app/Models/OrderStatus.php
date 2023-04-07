<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    public function scopeActive($query)
    {
        return $query->where('order_statuses.status', 1);
    }
    public function scopeInActive($query)
    {
        return $query->where('order_statuses.status', 0);
    }
}
