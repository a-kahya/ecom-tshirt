<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription – TeeShop</title>
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
        <h1 class="legal-titre">Inscription</h1>

        <form method="POST" action="{{ route('inscription.envoyer') }}" class="connexion-form" novalidate>
            @csrf

            @if ($errors->has('echec'))
                <p class="connexion-erreur connexion-erreur-general" role="alert">{{ $errors->first('echec') }}</p>
            @elseif ($errors->any())
                <p class="connexion-erreur connexion-erreur-general" role="alert">
                    L'inscription n'a pas pu être effectuée : vérifiez les champs signalés ci-dessous.
                </p>
            @endif

            @foreach ([
                'nom' => ['Nom', 'text', 'family-name'],
                'prenom' => ['Prénom', 'text', 'given-name'],
                'adresse' => ['Adresse', 'text', 'street-address'],
                'code_postal' => ['Code postal', 'text', 'postal-code'],
                'ville' => ['Ville', 'text', 'address-level2'],
                'email' => ['Adresse e-mail', 'email', 'email'],
            ] as $champ => [$libelle, $type, $auto])
                <label for="{{ $champ }}">{{ $libelle }}</label>
                <input type="{{ $type }}" id="{{ $champ }}" name="{{ $champ }}" value="{{ old($champ) }}" autocomplete="{{ $auto }}"@if ($champ === 'code_postal') inputmode="numeric" maxlength="4"@endif>
                @error($champ)
                    <p class="connexion-erreur" role="alert">{{ $message }}</p>
                @enderror
            @endforeach

            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" autocomplete="new-password">
            <div id="password-meter" class="meter" hidden>
                <div class="meter-piste"><div class="meter-barre"></div></div>
                <p class="meter-texte"></p>
            </div>
            <p class="connexion-aide">Au moins une majuscule, un chiffre et un caractère spécial.</p>
            @error('password')
                <p class="connexion-erreur" role="alert">{{ $message }}</p>
            @enderror

            <button type="submit" class="cookie-btn cookie-btn-accept connexion-btn">S'inscrire</button>
        </form>

        <p class="connexion-alt">Déjà inscrit ? <a href="{{ route('connexion') }}">Se connecter</a></p>
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
