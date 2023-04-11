<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        Paginator::useBootstrap(); // here we have added code.

        $categories = Category::query()->with('children')->Active()->where('parent_id',0)->orderBy('sort_order', 'ASC')->get();
        View::share('categories', $categories);
        
        $cloudFrontUrl = env('CLOUDFRONTURL')."categories/";;
        View::share('cloudFrontUrl', $cloudFrontUrl);

        $countries = Country::query()->orderBy('sort_order', 'asc')->get();
        View::share('countries', $countries);

        //$blogLists = Blog::Active()->inRandomOrder()->limit(8)->get()->toArray();
        $blogLists = Blog::Active()->where('slug','!=',$request->segment(3))->limit(8)->get()->toArray();
        View::share('blogLists', $blogLists);
    }
}
