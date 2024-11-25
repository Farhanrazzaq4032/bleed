<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReleaseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




//admin routes
Route::get('admin/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('/artists', ArtistController::class);
    Route::resource('/admins', AdminController::class);
    Route::resource('/releases', ReleaseController::class);
    Route::get('/artists/delete_download/{id}', [ArtistController::class, 'delete_download'])->name('artists.delete_download');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//website routes
Route::get('/artists', [HomeController::class, 'artists'])->name('artists');
Route::get('/artists/{artist:slug}', [HomeController::class, 'artistDetail'])->name('artist.detail');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('artist/{artist:slug}', [HomeController::class, 'artist'])->name('artist.releases');
Route::get('release/{release:slug}', [HomeController::class, 'release'])->name('release.detail');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('test', [HomeController::class, 'test'])->name('test');

Route::controller(HomeController::class)->group(function () {
Route::get('/service', 'service')->name('service');
});

Route::get('/migratefhnbleed', function(){
    Artisan::call('migrate');
    dd('migrated!');
});

require __DIR__ . '/auth.php';
