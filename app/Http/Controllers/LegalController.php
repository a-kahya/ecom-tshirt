<?php

namespace App\Http\Controllers;

use App\Models\Category;

class LegalController extends Controller
{
    public function confidentialite()
    {
        return view('legal.confidentialite', ['categories' => Category::all()]);
    }

    public function cgv()
    {
        return view('legal.cgv', ['categories' => Category::all()]);
    }

    public function cookies()
    {
        return view('legal.cookies', ['categories' => Category::all()]);
    }
}
