<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', function () {
    $products = Product::latest()->take(6)->get(); // Ambil 6 produk terbaru
    $totalStock = Product::sum('stock'); // Total semua stok

    return view('index', compact('products', 'totalStock'));
})->name('index');

// Socialite Routes (Public)
Route::prefix('auth')
    ->name('google.')
    ->group(function () {
        Route::get('/google/redirect', [
            SocialiteController::class,
            'redirect',
        ])->name('redirect');
        Route::get('/google/callback', [
            SocialiteController::class,
            'callback',
        ])->name('callback');
    });

// Protected Routes (Memerlukan Authentication)
Route::middleware(['auth'])->group(function () {
    // Dashboard Route (dengan middleware verified)
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])
        ->middleware(['verified'])
        ->name('dashboard');

    // Profile Routes
    Route::prefix('profile')
        ->name('profile.')
        ->group(function () {
            // Halaman utama profile (menggunakan view admin.pages.profile)
            Route::get('/', [ProfileController::class, 'profile'])->name(
                'index',
            );

            // Halaman edit profile
            Route::get('/edit', [ProfileController::class, 'edit'])->name(
                'edit',
            );
            Route::patch('/update', [ProfileController::class, 'update'])->name(
                'update',
            );

            // Halaman change password
            Route::get('/change-password', [
                ProfileController::class,
                'changePassword',
            ])->name('change-password');
            Route::post('/change-password', [
                ProfileController::class,
                'updatePassword',
            ])->name('change-password.update');

            // Delete account
            Route::delete('/delete', [
                ProfileController::class,
                'destroy',
            ])->name('destroy');
        });

    // Admin Routes (dengan prefix admin)
    Route::prefix('admin')
        ->name('admin.')
        ->middleware(['verified'])
        ->group(function () {
            // Product Management Routes
            Route::controller(ProductController::class)->group(function () {
                Route::get('/products', 'index')->name('products.index');
                Route::get('/products/create', 'create')->name(
                    'products.create',
                );
                Route::post('/products', 'store')->name('products.store');
                Route::get('/products/{product}/edit', 'edit')->name(
                    'products.edit',
                );
                Route::put('/products/{product}', 'update')->name(
                    'products.update',
                );
                Route::delete('/products/{product}', 'destroy')->name(
                    'products.destroy',
                );
            });

            // Alternative: Jika ingin menggunakan resource route (lebih ringkas)
            // Route::resource('products', ProductController::class)->except(['show']);
        });
});

// Auth Routes (Laravel Breeze/Fortify)
require __DIR__ . '/auth.php';
