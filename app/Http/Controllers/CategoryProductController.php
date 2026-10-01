<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryProductController extends Controller
{
    public function index(Category $category): View
    {
        $products = $category->products()->get();

        return view('products.index', [
            'category' => $category,
            'products' => $products,
        ]);
    }
}
