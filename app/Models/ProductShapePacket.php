<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Packet;

class ProductShapePacket extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','shape_id', 'packet_id','weight','pcs', 'price', 'created_at', 'updated_at'];

    public function packet()
    {
        return $this->belongsTo(Packet::class,'packet_id','id');
    }
}
