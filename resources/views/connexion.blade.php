<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion – TeeShop</title>
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

    <main class="connexion">
        <h1 class="legal-titre">Connexion</h1>

        <form method="POST" action="{{ route('connexion.envoyer') }}" class="connexion-form" novalidate>
            @csrf

            @if ($errors->has('echec'))
                <p class="connexion-erreur" role="alert">{{ $errors->first('echec') }}</p>
            @endif

            <label for="email">Adresse e-mail</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
            @error('email')
                <p class="connexion-erreur" role="alert">{{ $message }}</p>
            @enderror

            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" autocomplete="current-password">
            @error('password')
                <p class="connexion-erreur" role="alert">{{ $message }}</p>
            @enderror

            <button type="submit" class="cookie-btn cookie-btn-accept connexion-btn">Se connecter</button>
        </form>
        <p class="connexion-alt">Pas encore de compte ? <a href="{{ route('inscription') }}">S'inscrire</a></p>
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
