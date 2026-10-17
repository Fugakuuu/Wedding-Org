<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KatalogPaketController;
use App\Http\Controllers\Admin\PesananController as AdminPesananController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PesananController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/katalog', [PaketController::class, 'index'])->name('katalog');

Route::get('/booking/{paket}', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

Route::get('/pesanan/{pesanan}', [PesananController::class, 'show'])->name('pesanan.show');
Route::get('/cek-pesanan', [PesananController::class, 'trackForm'])->name('pesanan.track');
Route::post('/cek-pesanan', [PesananController::class, 'track'])->name('pesanan.track.submit');

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

Route::get('/admin/login', function () {
    return redirect()->route('login');
})->name('admin.login');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::middleware('auth:admin')->group(function () {
    // Dashboard → redirect ke Kelola Pesanan
    Route::get('/admin/dashboard', function () {
        return redirect()->route('admin.pesanan.index');
    })->name('admin.dashboard');

    Route::post('/admin/logout', [AdminAuthController::class, 'destroy'])->name('admin.logout');

    // Admin Pesanan
    Route::get('/admin/pesanan', [AdminPesananController::class, 'index'])->name('admin.pesanan.index');
    Route::get('/admin/pesanan/{pesanan}', [AdminPesananController::class, 'show'])->name('admin.pesanan.show');
    Route::patch('/admin/pesanan/{pesanan}/status', [AdminPesananController::class, 'updateStatus'])->name('admin.pesanan.status');

    // Admin Katalog CRUD
    Route::get('/admin/katalog', [KatalogPaketController::class, 'index'])->name('admin.katalog.index');
    Route::get('/admin/katalog/create', [KatalogPaketController::class, 'create'])->name('admin.katalog.create');
    Route::post('/admin/katalog', [KatalogPaketController::class, 'store'])->name('admin.katalog.store');
    Route::get('/admin/katalog/{paket}/edit', [KatalogPaketController::class, 'edit'])->name('admin.katalog.edit');
    Route::put('/admin/katalog/{paket}', [KatalogPaketController::class, 'update'])->name('admin.katalog.update');
    Route::delete('/admin/katalog/{paket}', [KatalogPaketController::class, 'destroy'])->name('admin.katalog.destroy');

    // Admin Profil
    Route::get('/admin/profil', [ProfilController::class, 'edit'])->name('admin.profil');
    Route::put('/admin/profil', [ProfilController::class, 'update'])->name('admin.profil.update');
});