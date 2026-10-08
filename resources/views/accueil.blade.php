<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teeshop</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body>

    <header class="navbar">
        <a href="#" class="logo">Tee<span>Shop</span></a>

        <nav>
            <ul class="nav-links">
                <li><a href="#">Homme</a></li>
                <li><a href="#">Femme</a></li>
                <li><a href="#">Enfants</a></li>
                <li>
                    <a href="#" class="cart">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.7 13.4a2 2 0 0 0 2 1.6h9.7a2 2 0 0 0 2-1.6L23 6H6"></path>
                        </svg>
                        Panier
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <main class="categories">
    @foreach ($categories as $categorie)
        <section class="categorie">
            <h2 class="categorie-titre">{{ $categorie['nom'] }}</h2>

            <div class="categorie-ligne">
                <div class="articles">
                    @foreach ($categorie['articles'] as $article)
                        <a href="#" class="article">
                            <img src="{{ $article['image'] }}" alt="{{ $article['nom'] }}">
                            <p class="article-prix">{{ number_format($article['prix'], 2, ',', ' ') }} €</p>
                        </a>
                    @endforeach
                </div>

                <a href="#" class="btn-voir-plus">Voir plus +</a>
            </div>
        </section>
    @endforeach
</main>
</body>
</html>