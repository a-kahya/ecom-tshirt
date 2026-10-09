<?php


use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $categories = Category::with('products')->get();
    $featured = Product::where('category_id', 1)->orderBy('id')->first();

    return view('accueil', compact('categories', 'featured'));
});

Route::get('/categorie/{category}', function (Category $category) {
    return view('categorie', ['category' => $category->load('products')]);
})->name('categorie.show');