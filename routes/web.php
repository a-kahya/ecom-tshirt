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