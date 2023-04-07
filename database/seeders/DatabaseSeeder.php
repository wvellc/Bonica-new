<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CreateAdminUserSeeder::class,
            CreateRolesSeeder::class,
            //CreateUserSeeder::class,
            CreateCategorySeeder::class,
            CreateCMSPageSeeder::class,
            CreateHomePageSliderSeeder::class,
            CountrySeeder::class,
            CreateShapeSeeder::class,
            CreateFAQCategorySeeder::class,
            CreateBlogCategorySeeder::class,
            CreateMetalSeeder::class,
            CreateMaterialSeeder::class,
            CreateSizeSeeder::class,
            CreateOrderStatusSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
