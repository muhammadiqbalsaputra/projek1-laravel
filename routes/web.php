<?php

use App\Http\Controllers\ProductCategoryController;
use App\Models\Products;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CartController;

// kode baru
Route::get('/', [HomepageController::class, 'index'])->name('home');
Route::get('products', [HomepageController::class, 'products']);
Route::get('product/{slug}', [HomepageController::class, 'product'])->name('product.show');
Route::get('categories', [HomepageController::class, 'categories']);
Route::get('category/{slug}', [HomepageController::class, 'category']);

Route::get('cart', [HomepageController::class, 'cart'])->name('cart.index');
Route::get('checkout', [HomepageController::class, 'checkout'])->name('checkout.index');

// kita panggil dulu controller nya


// // Kode Lama Page Homepage
// Route::get('/', function(){
//     $title = "Home";
//     return view('web.homepage', ['title'=>$title]);
// });


// Kode lama Page Product
// Route::get('products', function(){
//     $title = "Products";
//     return view('web.products', ['title'=>$title]);
// });



// Route::get('product/{slug}', function($slug){
//     $title = "Single Product";
//     return view('web.single_product', ['title'=>$title]);
// });

// Route::get('categories', function () {
//     $title = "Categories";
//     return view('web.categories', ['title' => $title]);
// });

// // Route::get('category/{slug}', function($slug){
// //     $title = "Single Catergories";
// //     return view('web.single_category', ['title'=>$title]);
// // });
// Route::get('cart', function () {
//     $title = "Cart";
//     return view('web.cart', ['title' => $title]);
// });
// Route::get('checkout', function () {
//     $title = "Checkout";
//     return view('web.checkout', ['title' => $title]);
// });

Route::resource('dashboard/categories', ProductCategoryController::class);

Route::resource('dashboard/products', ProductController::class);

Route::group(['middleware' => ['is_customer_login']], function () {
    Route::controller(CartController::class)->group(function () {
        Route::post('cart/add', 'add')->name('cart.add');
        Route::delete('cart/remove/{id}', 'remove')->name('cart.remove');
        Route::patch('cart/update/{id}', 'update')->name('cart.update');
    });
});

// Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'verified']], function () {
//    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
//    Route::resource('categories', ProductCategoryController::class);
//    Route::resource('product', ProductController::class);
// });

Route::group(['prefix' => 'customer'], function () {
    // route yang ada didalam iniakan dipanggil dengan presfix /customer

    route::controller(CustomerAuthController::class)->group(function () {

        route::group(['middleware' => 'check_customer_login'], function () {

            //tampilkan halaman login
            Route::get('login', 'login')->name('customer.login');
            //aksi login
            Route::post('login', 'store_login')->name('customer.store_login');
            //tampilkan halaman register
            Route::get('register', 'register')->name('customer.register');
            //aksi register
            Route::post('register', 'store_register')->name('customer.store_register');
        });

        //aksi logout
        Route::post('logout', 'logout')->name('customer.logout');

    });
    //    // tampilkan halaman login dan register
//     Route::get('login',[HomepageController::class,'login']);
//     Route::get ('register',[HomepageController::class,'login']);


});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';