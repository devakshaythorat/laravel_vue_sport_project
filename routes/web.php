<?php

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



//User Routes
Route::middleware(['auth','user','verified'])->prefix('/user')->name('user.')->group(function(){
    Route::get('/dashboard',[App\Http\Controllers\User\HomeController::class,'index'])->name('dashboard');
    Route::get('/subscribe/{id}',[App\Http\Controllers\User\HomeController::class,'subscribe'])->name('subscribe');
    Route::get('/unsubscribe/{id}',[App\Http\Controllers\User\HomeController::class,'unsubscribe'])->name('unsubscribe');

});


//Admin Routes
Route::middleware(['auth','admin','verified'])->prefix('/admin')->name('admin.')->group(function(){
    Route::get('/dashboard',[App\Http\Controllers\Admin\HomeController::class,'index'])->name('dashboard');
    Route::get('/sports/index',[App\Http\Controllers\Admin\SportController::class,'index'])->name('sports.index');
    Route::post('/sports/store',[App\Http\Controllers\Admin\SportController::class,'store'])->name('sports.store');
    Route::get('/sports/show/{id}',[App\Http\Controllers\Admin\SportController::class,'show'])->name('sports.show');
    Route::put('/sports/update/{id}',[App\Http\Controllers\Admin\SportController::class,'update'])->name('sports.update');
    Route::delete('/sports/delete/{id}',[App\Http\Controllers\Admin\SportController::class,'delete'])->name('sports.delete');
    Route::get('/sports/users/{id}',[App\Http\Controllers\Admin\SportController::class,'users'])->name('sports.users');

});



require __DIR__.'/auth.php';
