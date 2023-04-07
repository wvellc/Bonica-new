<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;

class CreateCategorySeeder extends Seeder
{
    /**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		$category = [
            [
				'name' => 'Sale',
                'slug' => 'sale',
                'parent_id' => '0',
				'status' => '1',
                'description' => '',
                'sort_order' => 1,
			],
            [
				'name' => 'Rings',
                'slug' => 'rings',
				'parent_id' => '0',
				'status' => '1',
                'description' => '',
                'sort_order' => 2,
			],
            [
				'name' => 'Earrings',
                'slug' => 'earrings',
				'parent_id' => '0',
				'status' => '1',
                'description' => '',
                'sort_order' => 3,
			],
            [
				'name' => 'Bracelets',
                'slug' => 'bracelets',
				'parent_id' => '0',
				'status' => '1',
                'description' => '',
                'sort_order' => 4,
			],
            [
				'name' => 'Bangles',
                'slug' => 'bangles',
				'parent_id' => '0',
				'status' => '1',
                'description' => '',
                'sort_order' => 5,
			],
            [
				'name' => 'Pendants',
                'slug' => 'pendants',
				'parent_id' => '0',
				'status' => '1',
                'description' => '',
                'sort_order' => 6,
			],
			[
				'name' => 'Necklace',
                'slug' => 'necklace',
                'parent_id' => '0',
				'status' => '1',
                'description' => '',
                'sort_order' => 7,
            ],
            [
				'name' => 'Bands',
                'slug' => 'bands',
				'parent_id' => '2',
				'status' => '1',
                'description' => '',
                'sort_order' => 1,
			],
            [
				'name' => 'Solitaire',
                'slug' => 'solitaire',
				'parent_id' => '2',
				'status' => '1',
                'description' => '',
                'sort_order' => 2,
			],
            [
				'name' => 'Cocktail',
                'slug' => 'cocktail',
				'parent_id' => '2',
				'status' => '1',
                'description' => '',
                'sort_order' => 3,
			],
            [
				'name' => 'Charm rings',
                'slug' => 'charm-rings',
				'parent_id' => '2',
				'status' => '1',
                'description' => '',
                'sort_order' => 4,
			],

            [
				'name' => 'Studs',
                'slug' => 'studs',
				'parent_id' => '3',
				'status' => '1',
                'description' => '',
                'sort_order' => 1,
			],
            [
				'name' => 'Drops',
                'slug' => 'drops',
				'parent_id' => '3',
				'status' => '1',
                'description' => '',
                'sort_order' => 2,
			],
            [
				'name' => 'Bali',
                'slug' => 'bali',
				'parent_id' => '3',
				'status' => '1',
                'description' => '',
                'sort_order' => 3,
			],
            [
				'name' => 'Hoops',
                'slug' => 'hoops',
				'parent_id' => '3',
				'status' => '1',
                'description' => '',
                'sort_order' => 4,
			],
            [
				'name' => 'Solitaire',
                'slug' => 'solitaire-4',
				'parent_id' => '3',
				'status' => '1',
                'description' => '',
                'sort_order' => 5,
			],

            [
				'name' => 'Tennis',
                'slug' => 'tennis',
				'parent_id' => '4',
				'status' => '1',
                'description' => '',
                'sort_order' => 1,
			],
            [
				'name' => 'Stiff',
                'slug' => 'stiff',
				'parent_id' => '4',
				'status' => '1',
                'description' => '',
                'sort_order' => 2,
			],
            [
				'name' => 'Flexible',
                'slug' => 'flexible',
				'parent_id' => '4',
				'status' => '1',
                'description' => '',
                'sort_order' => 3,
			],
            [
				'name' => 'Charm',
                'slug' => 'charm',
				'parent_id' => '4',
				'status' => '1',
                'description' => '',
                'sort_order' => 4,
			],
            [
				'name' => 'Solitaire',
                'slug' => 'solitaire-2',
				'parent_id' => '4',
				'status' => '1',
                'description' => '',
                'sort_order' => 5,
			],

            [
				'name' => 'Round Bangless',
                'slug' => 'round-bangles',
				'parent_id' => '5',
				'status' => '1',
                'description' => '',
                'sort_order' => 1,
			],
            [
				'name' => 'Oval Bangles',
                'slug' => 'oval-bangles',
				'parent_id' => '5',
				'status' => '1',
                'description' => '',
                'sort_order' => 2,
			],
            [
				'name' => 'Cuffs',
                'slug' => 'cuffs',
				'parent_id' => '5',
				'status' => '1',
                'description' => '',
                'sort_order' => 3,
			],

            [
				'name' => 'Workwear',
                'slug' => 'workwear',
				'parent_id' => '6',
				'status' => '1',
                'description' => '',
                'sort_order' => 1,
			],
            [
				'name' => 'Partywear',
                'slug' => 'partywear',
				'parent_id' => '6',
				'status' => '1',
                'description' => '',
                'sort_order' => 2,
			],
            [
				'name' => 'Casual',
                'slug' => 'casual',
				'parent_id' => '6',
				'status' => '1',
                'description' => '',
                'sort_order' => 3,
			],
            [
				'name' => 'Solitaire',
                'slug' => 'solitaire-3',
				'parent_id' => '6',
				'status' => '1',
                'description' => '',
                'sort_order' => 4,
			]
		];
		Category::insert($category);
	}
}
