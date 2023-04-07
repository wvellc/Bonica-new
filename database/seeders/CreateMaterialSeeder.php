<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Material;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class CreateMaterialSeeder extends Seeder
{
    /**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		$materials = [
			[
				'name' => '10K',
				'sort_order' => '1',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => '14K',
				'sort_order' => '2',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => '18K',
				'sort_order' => '3',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			]
		];

		Material::insert($materials);
	}
}
