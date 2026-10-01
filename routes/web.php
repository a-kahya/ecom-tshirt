
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryProductController;

// Page d'accueil (US1)
Route::get('/', function () {
    return view('welcome');
});

// Catalogue des produits par catégorie (US2)
Route::get(
    '/categories/{category}/products',
    [CategoryProductController::class, 'index']
)->name('categories.products.index');
