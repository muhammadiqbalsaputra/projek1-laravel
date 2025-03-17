<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/pengguna',function (){
    return "ini merupakan halaman pengguna. halaman ini merupakan halaman yang berisikan data dari pengguna";
});

Route::get('/produk',function (){
    return "ini halaman produk. Halaman ini berisikan produk produk yang terjual";
});

Route::get('/keranjang',function (){
    return "ini halaman keranjang berisikan produk produk yang telah dipilih oleh konsumen";
});

Route::get('/checkout',function (){
    return "ini halaman checkout yang dimana halaman ini akan menginput lokasi konsumen dan harga yang ditampilkan dari produk yang dibeli";
});

Route::get('/pembayaran',function (){
    return "ini halaman pembayaran yang dimana pada halaman ini konsumen akan membayar barang yang dibeli";
});

Route::get('/rating',function (){
    return "ini halaman rating. halaman ini berisikan review dari produk yang telah terjual";
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

require __DIR__.'/auth.php';
