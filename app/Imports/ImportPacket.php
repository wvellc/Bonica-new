<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Shape;
use App\Models\Color;
use App\Models\Clarity;
use App\Models\Packet;

class ImportPacket implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        if(!empty($collection))
        {
            $collection = $collection->toArray();
            $removeFirstIndex = array_shift($collection);

            foreach ($collection as $key => $packetData) {
                $shape = ucfirst($packetData[2]);
                $color = ucwords($packetData[3]);
                $clarity = ucwords($packetData[4]);
                
                $shapeId = Shape::select('id')->where('name',$shape)->first();
                $colorId = Color::select('id')->where('name',$color)->first();
                $clarityId = Clarity::select('id')->where('name',$clarity)->first();

                $packet = new Packet();
                $packet->name = $packetData[0];
                $packet->diamond_size = $packetData[1];
                $packet->shape_id = $shapeId->id;
                $packet->color_id = $colorId->id;
                $packet->clarity_id = $clarityId->id;
                $packet->price = $packetData[5];
                $packet->save();
            }
        }
    }
}
