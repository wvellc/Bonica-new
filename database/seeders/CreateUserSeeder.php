<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUserSeeder extends Seeder
{
    /**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		$users = [
			[
				'first_name' => 'Hitesh',
				'last_name' => 'Khandar',
                'slug' => 'hitesh',
				'email' => 'hitesh@gmail.com',
				'password' => bcrypt('123456'),
				'status' => '1',
                'role_id' => '1',
			]
		];

		User::insert($users);
	}
}
