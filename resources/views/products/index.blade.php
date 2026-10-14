<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->description }} - TeeShop</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <style>
        body {
            background-color: #ffffff;
            color: #111827;
        }

        .hero-categorie .hero-contenu {
            padding: 40px 24px;
        }

        .hero-categorie .hero-sous-titre {
            margin-bottom: 0;
        }

        .retour {
            display: inline-block;
            margin-bottom: 24px;
            color: #0b1f4d;
            font-weight: 500;
            text-decoration: none;
            transition: opacity 0.2s;
        }

        .retour:hover {
            opacity: 0.6;
        }

        .grille-articles {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 24px;
        }

        .article-image {
            position: relative;
            display: block;
        }

        /* nom du produit en infobulle au survol de l'image */
        .article-nom {
            position: absolute;
            left: 50%;
            bottom: 12px;
            max-width: 90%;
            transform: translate(-50%, 8px);
            padding: 8px 18px;
            background-color: #0b1f4d;
            color: #ffffff;
            font-size: 0.9rem;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            border-radius: 999px;
            opacity: 0;
            transition: opacity 0.25s ease, transform 0.25s ease;
            pointer-events: none;
        }

        .article:hover .article-nom,
        .article:focus-visible .article-nom {
            opacity: 1;
            transform: translate(-50%, 0);
        }

        @media (hover: none) {
            .article-nom {
                opacity: 1;
                transform: translate(-50%, 0);
            }
        }

        .aucun-produit {
            padding: 48px 24px;
            text-align: center;
            background-color: #e6ecfa;
            border-radius: 24px;
            color: #0b1f4d;
        }

        .aucun-produit h2 {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .aucun-produit p {
            color: #4b5563;
        }
    </style>
</head>
<body>

    <header class="navbar">
        <a href="{{ route('accueil') }}" class="logo">Tee<span>Shop</span></a>

        <nav>
            <ul class="nav-links">
                @foreach ($categories as $cat)
                    <li><a href="{{ route('categorie', $cat) }}">{{ $cat->description }}</a></li>
                @endforeach
                <li>
                    <a href="{{ route('panier') }}" class="cart">
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

    <section class="hero hero-categorie">
        <div class="hero-contenu">
            <div class="hero-texte">
                <h1 class="hero-titre">{{ $category->description }}</h1>
                <p class="hero-sous-titre">
                    {{ $products->count() }} produit(s) disponible(s)
                </p>
            </div>
        </div>
    </section>

    <main class="categories">
        <a href="{{ route('accueil') }}" class="retour">← Retour à l'accueil</a>

        @if ($products->isEmpty())
            <div class="aucun-produit">
                <h2>Aucun produit disponible</h2>
                <p>Aucun produit n'est actuellement associé à cette catégorie.</p>
            </div>
        @else
            <div class="grille-articles">
                @foreach ($products as $product)
                    <a
                        href="{{ route('produit', $product) }}"
                        class="article"
                        title="{{ $product->nom }}"
                        aria-label="Voir les détails de {{ $product->nom }}"
                    >
                        <span class="article-image">
                            <img
                                src="{{ $product->image ? asset($product->image) : asset('images/placeholder.png') }}"
                                alt="{{ $product->nom }}"
                            >
                            <span class="article-nom">{{ $product->nom }}</span>
                        </span>
                        <p class="article-prix">{{ number_format($product->prix, 2, ',', ' ') }} €</p>
                    </a>
                @endforeach
            </div>
        @endif
    </main>

    <footer class="footer">
        <div class="footer-contenu">
            <div class="footer-marque">
                <a href="{{ route('accueil') }}" class="footer-logo">Tee<span>Shop</span></a>
                <p class="footer-slogan">Nouvelle tendance, nouveau vous.</p>
            </div>

            <nav class="footer-colonne">
                <h3 class="footer-titre">Boutique</h3>
                <ul>
                    @foreach ($categories as $cat)
                        <li><a href="{{ route('categorie', $cat) }}">{{ $cat->description }}</a></li>
                    @endforeach
                </ul>
            </nav>

            <div class="footer-colonne">
                <h3 class="footer-titre">Contact</h3>
                <address class="footer-adresse">
                    <a href="mailto:contact@teeshop.example">contact@teeshop.example</a>
                    <span>12 rue des Tisserands</span>
                    <span>1000 Bruxelles, Belgique</span>
                </address>
            </div>
        </div>

        <div class="footer-bas">
            <p>© {{ date('Y') }} TeeShop. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>
