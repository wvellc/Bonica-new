<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryFaq;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class CreateFAQCategorySeeder extends Seeder
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
				'topic' => 'Popular Questions',
                'slug' => 'popular-questions',
				'icon' => 'popular-questions.svg',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'topic' => 'Shipping Questions',
                'slug' => 'shipping-questions',
				'icon' => 'shipping-questions.svg',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'topic' => 'Warranty',
                'slug' => 'warranty',
				'icon' => 'warranty.svg',
				'status' => '1',
                'created_at' => Carbon::now()->toDateTimeString()
			],

		];

		CategoryFaq::insert($cate);
	}
}
