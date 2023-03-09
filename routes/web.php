<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController as H;
use App\Http\Controllers\CountryController as C;
use App\Http\Controllers\FrontController as F;
use App\Http\Controllers\OrderController as O;


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

    Route::get('/', [F::class, 'home'])->name('home');
    Route::get('/country/{country}', [F::class, 'showHotel'])->name('show-hotel');
    Route::get('/hotel/{hotel}', [F::class, 'showHotelCountrys'])->name('show-hotel-countrys');
    Route::get('/country/{hotels}', [F::class, 'showCountryHotels'])->name('show-country-hotels');
    Route::get('/pdf/{country}', [F::class, 'pdf'])->name('show-pdf');
    Route::post('/add-basket', [F::class, 'addToBasket'])->name('add-basket');
    Route::get('/cart', [F::class, 'cart'])->name('cart');
    Route::get('/date', [F::class, 'date'])->name('date');
    Route::post('/add-date', [F::class, 'addToDate'])->name('add-date');
    Route::post('/cart', [F::class, 'updateCart'])->name('update-cart');
    Route::post('/make-order', [F::class, 'makeOrder'])->name('make-order')->middleware('roles:A|M|C');
    

Route::prefix('admin/hotels')->name('hotels-')->group(function () {
    Route::get('/', [H::class, 'index'])->name('index')->middleware('roles:A|M');
    Route::get('/create', [H::class, 'create'])->name('create')->middleware('roles:A|M');
    Route::post('/create', [H::class, 'store'])->name('store')->middleware('roles:A|M');
    Route::get('/edit/{hotel}', [H::class, 'edit'])->name('edit')->middleware('roles:A|M');
    Route::put('/edit/{hotel}', [H::class, 'update'])->name('update')->middleware('roles:A|M');
    Route::delete('/delete/{hotel}', [H::class, 'destroy'])->name('delete')->middleware('roles:A|M');
});

Route::prefix('admin/countrys')->name('countrys-')->group(function () {
    Route::get('/', [C::class, 'index'])->name('index')->middleware('roles:A|M');
    Route::get('/show/{country}', [C::class, 'show'])->name('show')->middleware('roles:A|M|C');
    Route::get('/pdf/{country}', [C::class, 'pdf'])->name('pdf')->middleware('roles:A|M|C');
    Route::get('/create', [C::class, 'create'])->name('create')->middleware('roles:A|M');
    Route::post('/create', [C::class, 'store'])->name('store')->middleware('roles:A|M');
    Route::get('/edit/{country}', [C::class, 'edit'])->name('edit')->middleware('roles:A|M');
    Route::put('/edit/{country}', [C::class, 'update'])->name('update')->middleware('roles:A|M');
    Route::delete('/delete/{country}', [C::class, 'destroy'])->name('delete')->middleware('roles:A|M');
});


Route::prefix('admin/order')->name('order-')->group(function () {
    Route::get('/', [O::class, 'index'])->name('index')->middleware('roles:A|M');
    Route::put('/edit/{order}', [O::class, 'update'])->name('update')->middleware('roles:A|M');
    Route::post('/ticket/{order}', [O::class, 'ticket'])->name('ticket')->middleware('roles:A|M');
    Route::delete('/delete/{order}', [O::class, 'destroy'])->name('delete')->middleware('roles:A|M');
});



Auth::routes();
//Auth::routes(['register'=> false]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');