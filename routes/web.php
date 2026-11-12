<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryProductController;

// Page d'accueil (US1)
Route::get('/', function () {
    $categories = Category::with('products')->get();
    $featured = Product::where('category_id', 1)
        ->orderBy('id')
        ->first();

    return view('accueil', compact('categories', 'featured'));
})->name('accueil');


// Liste des produits d'une catégorie (US2 - ta partie)
Route::get(
    '/categorie/{category}',
    [CategoryProductController::class, 'index']
)->name('categorie');


// Panier
Route::get('/panier', function () {
    return view('panier');
})->name('panier');


// Détail d'un produit (US3)
Route::get('/produit/{product}', function (Product $product) {
    return view('produit', [
        'product' => $product->load('category'),
        'categories' => Category::all(),
    ]);
})->name('produit');

// Obligations légales : RGPD, CGV, cookies
Route::controller(App\Http\Controllers\LegalController::class)->group(function () {
    Route::get('/confidentialite', 'confidentialite')->name('legal.confidentialite');
    Route::get('/conditions-generales-de-vente', 'cgv')->name('legal.cgv');
    Route::get('/cookies', 'cookies')->name('legal.cookies');
});


// Connexion (US4)
Route::controller(App\Http\Controllers\AuthController::class)->group(function () {
    Route::get('/connexion', 'showLogin')->name('connexion');
    Route::post('/connexion', 'login')->name('connexion.envoyer');
});


// Inscription (US5)
Route::controller(App\Http\Controllers\InscriptionController::class)->group(function () {
    Route::get('/inscription', 'show')->name('inscription');
    Route::post('/inscription', 'store')->name('inscription.envoyer');
});
