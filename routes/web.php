<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| ROUTES FRONTEND (Public)
|--------------------------------------------------------------------------
*/

// Ta page d'accueil avec tous les produits
Route::get('/', [FrontendController::class, 'index'])->name('home');


/*
|--------------------------------------------------------------------------
| ROUTES ADMINISTRATION (Sécurisées par 'auth')
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {

    // Page d'accueil de l'admin (Liste des produits)
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    // Création de produit
    Route::get('/product/create', [ProductController::class, 'create'])->name('admin.product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('admin.product.store');

    // Modification de produit
    Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('admin.product.edit');
    Route::put('/product/{product}', [ProductController::class, 'update'])->name('admin.product.update');

    // Suppression de produit
    Route::delete('/product/{product}', [ProductController::class, 'destroy'])->name('admin.product.destroy');

    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
});

/*
|--------------------------------------------------------------------------
| ROUTES DE PROFIL (Installées par Breeze)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rediriger le dashboard par défaut de Breeze vers ton admin
Route::get('/dashboard', function () {
    return redirect()->route('admin.index');
})->middleware(['auth'])->name('dashboard');

// Inclut automatiquement les routes de login, register, logout, etc.
require __DIR__.'/auth.php';
