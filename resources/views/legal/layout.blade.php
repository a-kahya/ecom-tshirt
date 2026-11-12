<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titre') – TeeShop</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="legal-page">

    <header class="navbar">
        <a href="{{ route('accueil') }}" class="logo">Tee<span>Shop</span></a>

        <nav>
            <ul class="nav-links">
                @foreach ($categories as $category)
                    <li><a href="{{ route('categorie', $category) }}">{{ $category->description }}</a></li>
                @endforeach
                @include('partials.compte')
                <li><a href="{{ route('panier') }}" class="cart">Panier</a></li>
            </ul>
        </nav>
    </header>

    <main class="legal">
        <h1 class="legal-titre">@yield('titre')</h1>
        <p class="legal-maj">Dernière mise à jour : {{ date('d/m/Y') }}</p>

        @yield('contenu')
    </main>

    <footer class="footer">
        <div class="footer-bas">
            @include('partials.footer-legal')
            <p>© {{ date('Y') }} TeeShop. Tous droits réservés.</p>
        </div>
    </footer>

    @include('partials.cookie-banner')
</body>
</html>
