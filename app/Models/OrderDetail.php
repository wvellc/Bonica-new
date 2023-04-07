<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderStatus;
use App\Models\Order;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','order_id','product_name','product_slug','category_id','category_slug','subcategory_id','subcategory_slug', 'product_id', 'shape', 'metal', 'material', 'size', 'quantity', 'currency_symbol', 'price', 'order_status_id', 'image', 'image_path','center_diamond_color','center_diamond_clarity','side_diamond_color','side_diamond_clarity', 'created_at', 'updated_at'];

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id', 'id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

}
