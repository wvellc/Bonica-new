<?php
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MetalController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CMSPageController;
use App\Http\Controllers\Admin\FAQController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\HomePageController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\ShapeController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ClarityController;
use App\Http\Controllers\Admin\LabourController;
use App\Http\Controllers\Admin\MaterialMetalController;
use App\Http\Controllers\Admin\PacketController;

Route::group(['middleware' => ['checkrequest', 'HtmlMinifier', 'preventbackhistory'], 'as' => 'admin.'], function () {
    # Admin Login Routes...
    Route::group(['middleware' => ['checklogin']], function () {
        Route::get('/', [AdminAuthController::class, 'getLogin']);
        Route::get('login', [AdminAuthController::class, 'getLogin'])->name('login');
        Route::post('login', [AdminAuthController::class, 'postLogin'])->name('loginPost');


        # Admin Forgot Password Routes...
        Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('forgot.password');
        Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

        # Admin Reset Password Routes...
        Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('password/reset', [ResetPasswordController::class, 'submitResetPasswordForm'])->name('password.reset.store');
    });

    # After Login Admin Routes...
    Route::group(['middleware' => ['checkadmin']], function () {
        Route::get('logout', [AdminAuthController::class, 'logout'])->name('logout');

        # Dashboard Routes...
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::post('sales-value', [DashboardController::class, 'getSalesValue'])->name('sales.value');

        # Change Password Routes...
        Route::get('setting', [SettingController::class, 'changePassword'])->name('change.password');
        Route::post('change-password-update', [SettingController::class, 'changePasswordStore'])->name('change.password.store');

        # Admin Profile Routes...
        Route::post('profile-update', [SettingController::class, 'profileUpdateStore'])->name('profile.store');

        # Super Admin Routes
        Route::group(['middleware' => ['checksuperadmin']], function () {

            # Admin CRUD Routes...
            //Admin
            Route::resource('admin', AdminController::class);

            //User
            Route::post('user/status', [UserController::class, 'updateStatus'])->name('user.statusupdate');
            Route::resource('user', UserController::class);

            //Metal
            Route::post('metal/status', [MetalController::class, 'updateStatus'])->name('metal.statusupdate');
            Route::resource('metal', MetalController::class);

            //Material
            Route::post('material/status', [MaterialController::class, 'updateStatus'])->name('material.statusupdate');
            Route::resource('material', MaterialController::class);

            //Size
            Route::post('size/status', [SizeController::class, 'updateStatus'])->name('size.statusupdate');
            Route::get('search-country', [SizeController::class, 'searchCountry'])->name('search-country');
            Route::get('search-size', [SizeController::class, 'searchSize'])->name('search-size');
            Route::resource('size', SizeController::class);


            //Shape
            Route::post('shape/status', [ShapeController::class, 'updateStatus'])->name('shape.statusupdate');
            Route::resource('shape', ShapeController::class);

            //Clarity
            Route::post('clarity/status', [ClarityController::class, 'updateStatus'])->name('clarity.statusupdate');
            Route::resource('clarity', ClarityController::class);

            //Color
            Route::post('color/status', [ColorController::class, 'updateStatus'])->name('color.statusupdate');
            Route::resource('color', ColorController::class);

            //Labour
            Route::post('labour/status', [LabourController::class, 'updateStatus'])->name('labour.statusupdate');
            Route::resource('labour', LabourController::class);

            //Packet
            Route::post('packet/status', [PacketController::class, 'updateStatus'])->name('packet.statusupdate');
            Route::resource('packet', PacketController::class);

            //Material Metal
            Route::resource('materialmetal', MaterialMetalController::class);

            //Product

            Route::post('product-price-calculation', [ProductController::class, 'productPriceCalculation'])->name('product.price.calculation');
            Route::post('delete-side-diamond-packet', [ProductController::class, 'deleteSideDiamondPacket'])->name('product.delete.side.diamond.packet');

            Route::post('updateimageattribute', [ProductController::class, 'updateImageAttribute'])->name('product.updateimageattribute');
            Route::post('deleteimage', [ProductController::class, 'deleteImage'])->name('product.deleteimage');
            Route::post('getsubproduct', [ProductController::class, 'getSubProduct'])->name('product.getsubproduct');
            Route::post('product/status', [ProductController::class, 'updateStatus'])->name('product.statusupdate');
            Route::resource('product', ProductController::class);


            //Category
            Route::get('search-cate-product', [CategoryController::class, 'searchCateProduct'])->name('search-cate-product');
            Route::post('category/status', [CategoryController::class, 'updateStatus'])->name('category.statusupdate');
            Route::resource('category', CategoryController::class);

            //CMS Page
            Route::post('deletesizeguideimage', [CMSPageController::class, 'deleteSizeGuideImage'])->name('cmspage.deletesizeguideimage');

            Route::post('deletemilestone', [CMSPageController::class, 'deleteMilestone'])->name('cmspage.deletemilestone');
            Route::post('deleteteam', [CMSPageController::class, 'deleteTeam'])->name('cmspage.deleteteam');
            Route::get('cmspage/{title?}', [CMSPageController::class, 'pageediting'])->name('cmspage');
            Route::post('cmspage/status', [CMSPageController::class, 'updateStatus'])->name('cmspage.statusupdate');
            Route::resource('cmspage', CMSPageController::class);

            //FAQ
            Route::get('faq_content', [FAQController::class, 'getContent'])->name('faq.content');
            Route::post('faq/status', [FAQController::class, 'updateStatus'])->name('faq.statusupdate');
            Route::resource('faq', FAQController::class);


            //Country
            Route::post('country_shipping_charge', [CountryController::class, 'saveShippingCharge'])->name('save_shipping_charge');
            Route::get('country_shipping_charge', [CountryController::class, 'shippingCharge'])->name('shipping_charge');
            Route::resource('country', CountryController::class);

            //Home Page
            Route::post('deletebannerimage', [HomePageController::class, 'deleteBannerImage'])->name('deletebannerimage');
            Route::get('search-category', [HomePageController::class, 'searchCategory'])->name('search-category');
            Route::post('homepagesliderimage/delete', [HomePageController::class, 'dropzoneDelete'])->name('homepageslider.dropzone.delete');
            Route::post('homepagesliderimage/store', [HomePageController::class, 'dropzoneStore'])->name('homepageslider.dropzone.store');
            Route::post('homepageslider/status', [HomePageController::class, 'updateStatus'])->name('homepageslider.statusupdate');
            Route::post('homepage/{id}', [HomePageController::class, 'update'])->name('homepage.update');
            Route::get('homepage', [HomePageController::class, 'index'])->name('homepage.index');

            /*BlogCategory*/
            Route::post('blogcategory/status', [BlogCategoryController::class, 'updateStatus'])->name('blogcategory.statusupdate');
            Route::resource('blogcategory', BlogCategoryController::class);

            /*Blog*/
            Route::get('blog_content', [BlogController::class, 'getContent'])->name('blog.content');
            Route::post('blog/status', [BlogController::class, 'updateStatus'])->name('blog.statusupdate');
            Route::resource('blog', BlogController::class);

            /*Content*/
            Route::get('content', [ContactController::class, 'getContent'])->name('content');
            Route::resource('contact', ContactController::class);

            /*Appointment*/
            Route::get('get-appointment', [AppointmentController::class, 'getContent'])->name('appointment-content');
            Route::resource('appointment', AppointmentController::class);


            //Coupon
            Route::post('coupon/status', [CouponController::class, 'updateStatus'])->name('coupon.statusupdate');
            Route::resource('coupon', CouponController::class);


            //CMS Testimonial

            Route::post('testimonial/status', [TestimonialController::class, 'updateStatus'])->name('testimonial.statusupdate');
            Route::resource('testimonial', TestimonialController::class);

            //Order
            Route::post('order/shipping/status', [OrderController::class, 'updateShippingStatus'])->name('order.shippingstatusupdate');
            Route::post('order/status', [OrderController::class, 'updateStatus'])->name('order.statusupdate');
            Route::resource('order', OrderController::class);


            /*NewsletterController*/
            Route::resource('newsletter', NewsletterController::class);
        });
    });
});
