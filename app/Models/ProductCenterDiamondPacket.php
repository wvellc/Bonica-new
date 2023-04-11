<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Color;
use App\Models\Clarity;

class ProductCenterDiamondPacket extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','shape_id','color_id', 'clarity_id', 'packet_id','weight','pcs', 'price', 'created_at', 'updated_at'];

    public function packet()
    {
        return $this->belongsTo(Packet::class,'packet_id','id');
    }
    public function color()
    {
        return $this->belongsTo(Color::class,'color_id','id');
    }
    public function clarity()
    {
        return $this->belongsTo(Clarity::class,'clarity_id','id');
    }
}
