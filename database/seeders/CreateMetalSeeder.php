<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Metal;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class CreateMetalSeeder extends Seeder
{
    /**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		$metals = [
			[
				'name' => 'Yellow Gold',
                'bgcolor' => '#D4AF37',
				'sort_order' => '1',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => 'White Gold',
                'bgcolor' => '#CECECE',
				'sort_order' => '2',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => 'Rose Gold',
                'bgcolor' => '#FFC1C1',
				'sort_order' => '3',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => 'Silver',
                'bgcolor' => '#E2E5E6',
				'sort_order' => '4',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => 'Platinum',
                'bgcolor' => '#C8C8C8',
				'sort_order' => '5',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			]



		];

		Metal::insert($metals);
	}
}
