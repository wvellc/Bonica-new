<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomePageSlider;
use App\Models\HomePage;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class CreateHomePageSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $homepage = [
            [
                'name' => 'Home Page',
                'slug' => 'home-page',
                'status' => 1,
                'created_at' => Carbon::now()->toDateTimeString()
            ],
        ];
        HomePage::insert($homepage);

        $users = [
            [
                'status' => 0,
                'created_at' => Carbon::now()->toDateTimeString()
            ]
        ];
        HomePageSlider::insert($users);
    }
}
