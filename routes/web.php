<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
});

Route::get('/', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');

//Grupo de rotas protegidos
Route::middleware(['auth'])->group(function () {
    /*Route::get('/create', function () {
        return view('properties.create');
    });*/
    Route::get('/create', [PropertyController::class, 'create'])->name('create'); 
    Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
    Route::post('/properties/{property}/favorite', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/properties/{property}/favorite', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

    Route::post('/properties/{property}/favorites', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/properties/{property}/favorites', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
});

//Rotas do Adm

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Outras rotas administrativas
});

require __DIR__.'/auth.php';
