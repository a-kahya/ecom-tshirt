<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $categories = [
        [
            'nom' => 'Homme',
            'articles' => [
                ['nom' => 'T-shirt noir',  'prix' => 19.99, 'image' => 'https://picsum.photos/seed/homme1/400'],
                ['nom' => 'T-shirt blanc', 'prix' => 17.99, 'image' => 'https://picsum.photos/seed/homme2/400'],
                ['nom' => 'T-shirt bleu',  'prix' => 21.99, 'image' => 'https://picsum.photos/seed/homme3/400'],
            ],
        ],
        [
            'nom' => 'Femme',
            'articles' => [
                ['nom' => 'T-shirt rose',  'prix' => 18.99, 'image' => 'https://picsum.photos/seed/femme1/400'],
                ['nom' => 'T-shirt beige', 'prix' => 19.99, 'image' => 'https://picsum.photos/seed/femme2/400'],
                ['nom' => 'T-shirt vert',  'prix' => 22.99, 'image' => 'https://picsum.photos/seed/femme3/400'],
            ],
        ],
        [
            'nom' => 'Enfants',
            'articles' => [
                ['nom' => 'T-shirt jaune',  'prix' => 12.99, 'image' => 'https://picsum.photos/seed/enfant1/400'],
                ['nom' => 'T-shirt rouge',  'prix' => 12.99, 'image' => 'https://picsum.photos/seed/enfant2/400'],
                ['nom' => 'T-shirt orange', 'prix' => 13.99, 'image' => 'https://picsum.photos/seed/enfant3/400'],
            ],
        ],
    ];

    return view('accueil', compact('categories'));
});