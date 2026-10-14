<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->nom }} - TeeShop</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <style>
        body {
            background-color: #ffffff;
            color: #111827;
        }

        .fil-ariane {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px;
            margin-bottom: 32px;
            font-size: 0.9rem;
            color: #6b7280;
        }

        .fil-ariane a {
            color: #0b1f4d;
            text-decoration: none;
            font-weight: 500;
            transition: opacity 0.2s;
        }

        .fil-ariane a:hover {
            opacity: 0.6;
        }

        .fil-ariane .courant {
            color: #6b7280;
        }

        .produit-detail {
            display: flex;
            align-items: center;
            gap: 64px;
        }

        .produit-photo {
            flex: 1;
            max-width: 520px;
            overflow: hidden;
            border-radius: 24px;
            background-color: #f3f4f6;
            box-shadow: 0 16px 32px rgba(11, 31, 77, 0.15);
        }

        .produit-photo img {
            display: block;
            width: 100%;
            height: auto;
        }

        .produit-infos {
            flex: 1;
        }

        .produit-categorie {
            display: inline-block;
            margin-bottom: 16px;
            padding: 6px 14px;
            background-color: #e6ecfa;
            color: #0b1f4d;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            border-radius: 999px;
        }

        .produit-nom {
            font-size: 2.2rem;
            font-weight: 800;
            line-height: 1.15;
            color: #0b1f4d;
            margin-bottom: 24px;
        }

        .produit-liste {
            margin: 0 0 32px;
            border-top: 1px solid #e5e7eb;
        }

        .produit-ligne {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .produit-ligne dt {
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #6b7280;
        }

        .produit-ligne dd {
            margin: 0;
            font-size: 1.1rem;
            color: #111827;
        }

        .produit-ligne .produit-prix {
            font-size: 1.8rem;
            font-weight: 800;
            color: #0b1f4d;
        }

        @media (max-width: 700px) {
            .produit-detail {
                flex-direction: column;
                align-items: stretch;
                gap: 32px;
            }

            .produit-photo {
                max-width: none;
            }

            .produit-nom {
                font-size: 1.8rem;
            }
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

    <main class="categories">
        <nav class="fil-ariane" aria-label="Fil d'Ariane">
            <a href="{{ route('accueil') }}">Accueil</a>
            <span>›</span>
            <a href="{{ route('categorie', $product->category) }}">{{ $product->category->description }}</a>
            <span>›</span>
            <span class="courant">{{ $product->nom }}</span>
        </nav>

        <article class="produit-detail">
            <div class="produit-photo">
                <img
                    src="{{ $product->image ? asset($product->image) : asset('images/placeholder.png') }}"
                    alt="{{ $product->nom }}"
                >
            </div>

            <div class="produit-infos">
                <a href="{{ route('categorie', $product->category) }}" class="produit-categorie">
                    {{ $product->category->description }}
                </a>

                <h1 class="produit-nom">{{ $product->nom }}</h1>

                <dl class="produit-liste">
                    <div class="produit-ligne">
                        <dt>Nom</dt>
                        <dd>{{ $product->nom }}</dd>
                    </div>
                    <div class="produit-ligne">
                        <dt>Marque</dt>
                        <dd>{{ $product->marque }}</dd>
                    </div>
                    <div class="produit-ligne">
                        <dt>Prix</dt>
                        <dd class="produit-prix">{{ number_format($product->prix, 2, ',', ' ') }} €</dd>
                    </div>
                </dl>

                <a href="{{ route('categorie', $product->category) }}" class="hero-btn">
                    ← Retour à {{ $product->category->description }}
                </a>
            </div>
        </article>
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
