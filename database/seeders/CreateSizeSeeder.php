<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Size;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class CreateSizeSeeder extends Seeder
{
    /**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		$sizes = [
			[
				'name' => '4.5',
				'sort_order' => '1',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => '4.75',
				'sort_order' => '2',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => '5',
				'sort_order' => '3',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => '5.25',
				'sort_order' => '4',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => '5.5',
				'sort_order' => '5',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => '6',
				'sort_order' => '6',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => '6.25',
				'sort_order' => '7',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => '6.5',
				'sort_order' => '8',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => '6.75',
				'sort_order' => '8',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => '7',
				'sort_order' => '9',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => '7.25',
				'sort_order' => '10',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => '7.5',
				'sort_order' => '11',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => '7.75',
				'sort_order' => '12',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => '8',
				'sort_order' => '13',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => '8.25',
				'sort_order' => '14',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			]

		];

		Size::insert($sizes);
	}
}
