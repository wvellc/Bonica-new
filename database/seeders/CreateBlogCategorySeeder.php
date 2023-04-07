<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class CreateBlogCategorySeeder extends Seeder
{
    /**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$cate = [
            [
				'name' => 'General Inspiration',
                'slug' => 'general-inspiration',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => 'General Lifestyle',
                'slug' => 'general-lifestyle',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => 'Jewelry Knowledge',
                'slug' => 'jewelry-knowledge',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => 'Latest Post',
                'slug' => 'latest-post',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			]
		];
		BlogCategory::insert($cate);
	}
}
