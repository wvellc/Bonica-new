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

                $shapeId = null;
                $colorId = null;
                $clarityId = null;

                if($shape){
                    $shapeId = Shape::select('id')->where('name',$shape)->first();
                    $shapeId = $shapeId->id;
                }
                if($color){
                    $colorId = Color::select('id')->where('name',$color)->first();
                    $colorId = $colorId->id;
                }
                if($clarity){
                    $clarityId = Clarity::select('id')->where('name',$clarity)->first();
                    $clarityId = $clarityId->id;
                }

                $packet = Packet::firstOrNew([
                                'name' => $packetData[0],
                            ]);
                $packet->name = $packetData[0];
                $packet->diamond_size = $packetData[1];
                $packet->shape_id = $shapeId;
                $packet->color_id = $colorId;
                $packet->clarity_id = $clarityId;
                $packet->price = $packetData[5];
                $packet->save();
            }
        }
    }
}
