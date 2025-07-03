<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StrukController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //route utama
    Route::resource('barang', BarangController::class);
    Route::resource('transaksi', TransaksiController::class);

    //route struk
    Route::get('/struk/{id}', [StrukController::class,'show'])->name('struk.show');
    Route::get('/struk/{id}/pdf', [StrukController::class,'pdf'])->name('struk.pdf');
});


require __DIR__ . '/auth.php';
