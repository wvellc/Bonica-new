<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class CreateAdminUserSeeder extends Seeder
{
    /**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		
		$admin = [
			[
				'name' => 'Admin',
				'email' => 'admin@admin.com',
				'password' => bcrypt('123456'),
				'is_super' => '1',
			],
		];

		Admin::insert($admin);
	}
}
