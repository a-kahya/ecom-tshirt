<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\ProfilController;

// Page d'accueil (US1)
Route::get('/', function () {
    $categories = Category::with('products')->get();
    $featured = Product::where('category_id', 1)
        ->orderBy('id')
        ->first();

    return view('accueil', compact('categories', 'featured'));
})->name('accueil');


// Liste des produits d'une catégorie (US2)
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


// Connexion (US4) et déconnexion (US7)
Route::controller(App\Http\Controllers\AuthController::class)->group(function () {
    Route::get('/connexion', 'showLogin')->name('connexion');
    Route::post('/connexion', 'login')->name('connexion.envoyer');

    // Déconnexion : en POST (et pas en GET) pour qu'un lien extérieur ne puisse pas déconnecter l'utilisateur
    Route::post('/deconnexion', 'logout')->name('deconnexion');
});


// Inscription (US5)
Route::controller(App\Http\Controllers\InscriptionController::class)->group(function () {
    Route::get('/inscription', 'show')->name('inscription');
    Route::post('/inscription', 'store')->name('inscription.envoyer');
});

// Profil (US6) : réservé aux membres connectés, grâce au middleware "auth"
Route::middleware('auth')
    ->controller(App\Http\Controllers\ProfilController::class)
    ->group(function () {
        Route::get('/profil', 'show')->name('profil');
        // PUT = mise à jour d'une ressource existante (le formulaire l'envoie avec @method('PUT'))
        Route::put('/profil', 'update')->name('profil.envoyer');
    });
