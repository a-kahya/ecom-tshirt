<?php


use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $categories = Category::with('products')->get();
    $featured = Product::where('category_id', 1)->orderBy('id')->first();

    return view('accueil', compact('categories', 'featured'));
})->name('accueil');

Route::get('/categorie/{category}', function (Category $category) {
    return view('categorie', ['category' => $category->load('products')]);
})->name('categorie');

//route pour le panier, qd il faudra créer panier.blade.php
Route::get('/panier', function () {
    return view('panier');
})->name('panier');

//route pour produit
Route::get('/produit/{product}', function (Product $product) {
    return view('produit', ['product' => $product->load('category')]);
})->name('produit');