<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\User\ResetPasswordController;

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\AppointmentController;
use App\Http\Controllers\Frontend\FAQController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\CMSPageController;

use App\Http\Controllers\Frontend\RazorpayPaymentController;
use App\Http\Controllers\Frontend\GoogleSocialiteController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*For Clear Cache*/

Route::get('clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('debugbar:clear');
    return ["status" => 1, "msg" => "Cache cleared successfully!"];
});

Auth::routes();
Route::get('auth/google', [GoogleSocialiteController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleSocialiteController::class, 'handleCallback']);
// Front Route
# Before Login User Routes...
Route::group(['middleware' => ['checkrequest', 'HtmlMinifier'], 'namespace' => 'Frontend', 'as' => 'frontend.'], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('currency-update', [HomeController::class, 'currencyUpdate'])->name('currency-update');
    Route::post('search', [HomeController::class, 'Search'])->name('search');
    Route::post('newsletter', [HomeController::class, 'newsletter'])->name('newsletter');


    Route::get('login', [UserController::class, 'login'])->name('login');
    Route::post('login', [UserController::class, 'saveLogin'])->name('save.login');

    Route::get('signup', [UserController::class, 'signup'])->name('signup');
    Route::post('signup', [UserController::class, 'saveSignup'])->name('save.signup');
    Route::get('user-verify', [UserController::class, 'verify'])->name('user.verify');

    Route::view('password/forgot', 'frontend/users/forgot-password')->name('forgot-password');
    Route::post('password/forgot', [UserController::class, 'sendResetLink'])->name('forgot.password.link');

    Route::get('password/reset/{token}', [UserController::class, 'showResetForm'])->name('reset.password.form');
    Route::post('password/reset', [UserController::class, 'resetPassword'])->name('reset.password');

    Route::view('contact', 'frontend/contact')->name('contact');
    Route::post('contact', [ContactController::class, 'contactSave'])->name('save.contact');

    Route::view('appointment', 'frontend/appointment')->name('appointment');
    Route::post('appointment', [AppointmentController::class, 'appointmentSave'])->name('save.appointment');

    Route::get('faq', [FAQController::class, 'getAllFaq'])->name('faq');
    Route::get('search_faq', [FAQController::class, 'searchFAQ'])->name('search_faq');

    Route::get('blogs', [BlogController::class, 'blogs'])->name('blogs');
    Route::get('blog/blog-detail/{slug?}', [BlogController::class, 'blogDetail'])->name('blogdetail');
    Route::get('blog/{slug?}', [BlogController::class, 'categoryBlog'])->name('categoryblog');

    /*Product*/
    Route::post('get-product-price', [ProductController::class, 'getProductPrice'])->name('get-product-price');
    Route::post('get-product-price-image', [ProductController::class, 'getProductPriceImage'])->name('get-product-price-image');

    Route::post('add-remove-wishlist', [ProductController::class, 'addRemoveWishlist'])->name('add-remove-wishlist');
    Route::post('delete-wishlist', [ProductController::class, 'deleteWishlist'])->name('delete-wishlist');

    Route::view('mywishlist', 'frontend/products/mywishlist')->name('mywishlist');
    Route::post('get-wishlist-data', [ProductController::class, 'getWishlistData'])->name('get-wishlist-data');

    Route::post('getdata', [ProductController::class, 'getData'])->name('getdata');
    Route::post('get-discover-product', [ProductController::class, 'gatDiscoverProduct'])->name('get-discover-product');
    Route::post('get-shopthelook-product', [ProductController::class, 'gatShopthelookProduct'])->name('get-shopthelook-product');


    Route::get('products/{category}/{subcategory}/{product}', [ProductController::class, 'product'])->name('product_detail');
    Route::get('products/{category}/{subcategory}', [ProductController::class, 'showSubCategoryProduct'])->name('show_sub_category_product');
    Route::get('products/{category}', [ProductController::class, 'showCategoryProduct'])->name('show_category_product');


    Route::post('coupon-delete', [CartController::class, 'couponDelete'])->name('coupon-delete');
    Route::post('checked-coupon', [CartController::class, 'checkedCoupon'])->name('checked-coupon');

    Route::get('cart', [CartController::class, 'index'])->name('cart');
    Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
    Route::post('cart-quantity-update', [CartController::class, 'cartQuantityUpdate'])->name('cart-quantity-update');
    Route::post('cart-delete', [CartController::class, 'cartDelete'])->name('cart-delete');

    Route::post('checkout', [OrderController::class, 'checkout'])->name('checkout');
    route::get('/do-payment/', [RazorpayPaymentController::class, 'do_payment'])->name('do-payment');
    route::post('/store-payment', [RazorpayPaymentController::class, 'store_payment'])->name('store-payment');
    Route::view('thankyou', 'frontend/thankyou')->name('thankyou');


    //Route::get('cart', [CartController::class, 'index'])->name('cart');


    Route::get('page/{title?}/{option?}', [CMSPageController::class, 'index'])->name('page');
});

# After Login User Routes...
Route::group(['middleware' => ['checkuserlogin', 'checkrequest', 'HtmlMinifier'], 'namespace' => 'Frontend', 'as' => 'frontend.'], function () {

    /*myaccount*/
    Route::get('myorders/{order_id}', [UserController::class, 'myorderDetail'])->name('myorders-detail');
    Route::get('myorders', [UserController::class, 'myaccount'])->name('myorders');
    Route::get('myaccount', [UserController::class, 'myaccount'])->name('myaccount');
    Route::put('myaccount', [UserController::class, 'saveMyaccount'])->name('save.myaccount');

    Route::get('logout', [UserController::class, 'logout'])->name('logout');
});
