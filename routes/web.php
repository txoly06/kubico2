<?php

use App\Http\Controllers\UserPropertyController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminPropertyController;
use App\Http\Controllers\ContactController;
use app\Http\Controllers\ImageController;

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

// Rotas para páginas institucionais
Route::view('/sobre', 'about')->name('about');
Route::view('/contato', 'contact')->name('contact');
Route::view('/privacidade', 'privacy')->name('privacy');
Route::view('/termos', 'terms')->name('terms');

// Rotas existentes (mantenha suas rotas atuais aqui)
// ... outras rotas do seu sistema ...

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

/*Route::get('/profile', function () {
    return view('perfil.edit');
});*/


Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');

Route::get('/', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');

//Grupo de rotas protegidos
Route::middleware(['auth'])->group(function () {
    
    Route::get('/create', [PropertyController::class, 'create'])->name('create'); 
    Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
    Route::post('/properties/{property}/favorite', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/properties/{property}/favorite', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

    Route::post('/properties/{property}/favorites', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/properties/{property}/favorites', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    //edição de imoveis
    Route::get('/properties/{property}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
    Route::patch('/properties/{property}', [PropertyController::class, 'update'])->name('properties.update');

    // Rota para o painel do usuário
    Route::get('/my-properties', [UserPropertyController::class, 'index'])->name('user.properties.index');
    Route::patch('/my-properties/{property}', [UserPropertyController::class, 'update'])->name('user.properties.update');
    Route::get('/my-properties/{property}/edit', [UserPropertyController::class, 'edit'])->name('user.properties.edit');
    Route::delete('/properties/{property}/images/{image}', [PropertyController::class, 'destroyImage'])
    ->name('properties.images.destroy');
});

//Rotas do Adm

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Outras rotas administrativas

    
    //Admin Properties Routes
    Route::get('/admin/properties', [AdminPropertyController::class, 'index'])->name('admin.properties.index');
    Route::get('/admin/properties/create', [AdminPropertyController::class, 'create'])->name('admin.properties.create');
    Route::post('/admin/properties', [AdminPropertyController::class, 'store'])->name('admin.properties.store');
    Route::get('/admin/properties/{property}/edit', [AdminPropertyController::class, 'edit'])->name('admin.properties.edit');
    Route::patch('/admin/properties/{property}', [AdminPropertyController::class, 'update'])->name('admin.properties.update');
    Route::delete('/admin/properties/{property}', [AdminPropertyController::class, 'destroy'])->name('admin.properties.destroy');
    
    //Admin User Routes
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::patch('/admin/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/admin/export-properties', [AdminController::class, 'exportProperties'])
    ->name('admin.properties.export');
   
});

require __DIR__.'/auth.php';
