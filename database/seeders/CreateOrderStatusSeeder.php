<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class CreateOrderStatusSeeder extends Seeder
{
    /**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$orderStatus = [
            [
				'name' => 'Packing',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => 'Shipped',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => 'Delivered',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			]

		];
		OrderStatus::insert($orderStatus);
	}
}
