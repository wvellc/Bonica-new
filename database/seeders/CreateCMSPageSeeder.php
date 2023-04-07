<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CmsPage;
use App\Models\OurStory;
use App\Models\Sustainablity;
use App\Models\Bonica5bs3;
use App\Models\ourTeam;
use App\Models\sizeGuide;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class CreateCMSPageSeeder extends Seeder
{
    /**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		$cmspage = [
			[
				'name' => 'About',
                'slug' => 'about-us',
                'status' => 1,
				'created_at' => Carbon::now()->toDateTimeString()
			],

            [
				'name' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'status' => 1,
				'created_at' => Carbon::now()->toDateTimeString()
			],

            [
				'name' => 'Delivery & Returns',
                'slug' => 'delivery-returns',
                'status' => 1,
				'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => 'Warranty',
                'slug' => 'warranty',
                'status' => 1,
				'created_at' => Carbon::now()->toDateTimeString()
			],
            [
				'name' => 'Terms Of Use',
                'slug' => 'terms-of-use',
                'status' => 1,
				'created_at' => Carbon::now()->toDateTimeString()
			]
		];

		CmsPage::insert($cmspage);

        $ourstory = [
			[
				'name' => 'Our Story',
                'slug' => 'our-story',
                'status' => 1,
				'created_at' => Carbon::now()->toDateTimeString()
			],
		];
		OurStory::insert($ourstory);

        $sustainablity = [
			[
				'name' => 'Sustainablity',
                'slug' => 'sustainablity',
                'status' => 1,
				'created_at' => Carbon::now()->toDateTimeString()
			],
		];
		Sustainablity::insert($sustainablity);

        $bonica5bs3 = [
			[
				'name' => 'Bonica5bs3',
                'slug' => 'bonica5bs3',
                'status' => 1,
				'created_at' => Carbon::now()->toDateTimeString()
			],
		];
		Bonica5bs3::insert($bonica5bs3);

        $ourTeam = [
			[
				'name' => 'Our Team',
                'slug' => 'our-team',
                'status' => 1,
				'created_at' => Carbon::now()->toDateTimeString()
			],
		];
		ourTeam::insert($ourTeam);

        $sizeGuide = [
			[
				'name' => 'Size Guide',
                'slug' => 'size-guide',
                'status' => 1,
				'created_at' => Carbon::now()->toDateTimeString()
			],
		];
		sizeGuide::insert($sizeGuide);




	}
}
