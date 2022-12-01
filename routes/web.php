<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'App\Http\Middleware\UserMiddleware'], function()
{

    Route::get('/shop', [HomeController::class, 'index'])->name('shop');
    Route::get('/categories', [HomeController::class, 'categories'])->name('categories');
    Route::get('/product/{id}', [HomeController::class, 'product']);

    Route::post('/add-to-cart', [CheckoutController::class, 'addCart']);
    Route::get('/cart', [CheckoutController::class, 'cart'])->name('cart');
    Route::get('/cart/remove/{id}', [CheckoutController::class, 'cartRemove']);
    Route::get('/checkout', [CheckoutController::class, 'checkout']);
    Route::get('/checkout-ttl', [CheckoutController::class, 'checkoutTTL']);
    Route::get('/otp', [CheckoutController::class, 'otp']);
    Route::get('/resend-otp', [CheckoutController::class, 'otpResend']);
    Route::post('/otp', [CheckoutController::class, 'otpConfirm']);

    Route::get('/dashboard', [MemberController::class, 'index']);
    Route::get('/order/{id}', [MemberController::class, 'order']);

    Route::get('/set-cookie', [HomeController::class, 'setCookie']);
    Route::get('/get-cookie', [HomeController::class, 'getCookie']);


});

Route::group(['prefix' => 'admin', 'middleware' => 'App\Http\Middleware\AdminMiddleware'], function()
{
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/logout',[AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/logout',[AdminController::class, 'logout'])->name('admin.logout');

    Route::get('/users', [AdminController::class, 'create']);
    Route::post('/users', [AdminController::class, 'store']);
    Route::get('/users/{id}/edit', [AdminController::class, 'edit']);
    Route::post('/users/{id}', [AdminController::class, 'update']);
    Route::post('/users/password/{id}', [AdminController::class, 'updatePassword']);

    Route::get('/sellers', [SellerController::class, 'index']);
    Route::get('/sellers/create', [SellerController::class, 'create']);
    Route::post('/sellers', [SellerController::class, 'store']);
    Route::get('/sellers/{id}', [SellerController::class, 'edit']);
    Route::post('/sellers/{id}', [SellerController::class, 'update']);

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/create', [CategoryController::class, 'create']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::get('/categories/{id}', [CategoryController::class, 'edit']);
    Route::post('/categories/{id}', [CategoryController::class, 'update']);

    Route::get('/sub-categories', [SubCategoryController::class, 'index']);
    Route::get('/sub-categories/create', [SubCategoryController::class, 'create']);
    Route::post('/sub-categories', [SubCategoryController::class, 'store']);
    Route::get('/sub-categories/{id}', [SubCategoryController::class, 'edit']);
    Route::post('/sub-categories/{id}', [SubCategoryController::class, 'update']);

    Route::get('/brands', [BrandController::class, 'index']);
    Route::get('/brands/create', [BrandController::class, 'create']);
    Route::post('/brands', [BrandController::class, 'store']);
    Route::get('/brands/{id}', [BrandController::class, 'edit']);
    Route::post('/brands/{id}', [BrandController::class, 'update']);

    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/create', [ProductController::class, 'create']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::get('/products/{id}', [ProductController::class, 'edit']);
    Route::post('/products/{id}', [ProductController::class, 'update']);
    Route::post('/products/images/upload', [ProductController::class, 'upload']);



});

// UPDATE `orders` SET `activate_date`=`updated_at`  WHERE `activate_date` IS NULL

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:cache');
    Artisan::call('config:cache');

    return "Cache is cleared";
});

require __DIR__.'/auth.php';
