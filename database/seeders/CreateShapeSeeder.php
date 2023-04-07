<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shape;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class CreateShapeSeeder extends Seeder
{
    /**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		$shapes = [
			[
				'name' => 'Round',
                'image' => 'round.svg',
				'sort_order' => '1',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => 'Emerald',
                'image' => 'emerald.svg',
				'sort_order' => '2',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => 'Pear',
                'image' => 'pear.svg',
				'sort_order' => '3',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => 'Oval',
                'image' => 'oval.svg',
				'sort_order' => '4',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => 'Princess',
                'image' => 'princess.svg',
				'sort_order' => '5',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => 'Ascher',
                'image' => 'ascher.svg',
				'sort_order' => '6',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => 'Cushion',
                'image' => 'cushion.svg',
				'sort_order' => '7',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => 'Marquise',
                'image' => 'marquise.svg',
				'sort_order' => '8',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => 'Radiant',
                'image' => 'radiant.svg',
				'sort_order' => '9',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => 'Trillion',
                'image' => 'trillion.svg',
				'sort_order' => '10',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],

		];
		Shape::insert($shapes);
	}
}
