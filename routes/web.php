<?php

use App\Http\Controllers\Admin\SportController;
use App\Http\Controllers\User\HomeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

Route::middleware(['auth', 'verified'])->group(function () {

//User Routes
    Route::middleware(['user'])->prefix('/user')->name('user.')->group(function () {
        Route::controller(HomeController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('dashboard');
            Route::get('/subscribe/{sport}', 'subscribe')->name('subscribe');
            Route::get('/unsubscribe/{sport}', 'unsubscribe')->name('unsubscribe');
        });
    });

//Admin Routes
    Route::middleware(['admin'])->prefix('/admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('dashboard');
        Route::controller(SportController::class)->group(function () {
            Route::get('/sports', 'index')->name('sports.index');
            Route::post('/sports', 'store')->name('sports.store');
            Route::get('/sports/{sport}', 'show')->name('sports.show');
            Route::put('/sports/{sport}', 'update')->name('sports.update');
            Route::delete('/sports/{sport}', 'destroy')->name('sports.destroy');
            Route::get('/sports/{sport}/users', 'users')->name('sports.users');
        });
    });
});

require __DIR__ . '/auth.php';
