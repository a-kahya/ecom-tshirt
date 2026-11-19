<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon profil – TeeShop</title>
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
        <h1 class="legal-titre">Mon profil</h1>

        {{-- Message affiché après une mise à jour réussie (envoyé par ->with('succes', ...)) --}}
        @if (session('succes'))
            <p class="profil-succes" role="status">{{ session('succes') }}</p>
        @endif

        {{-- Message d'échec général (erreur technique à l'enregistrement) --}}
        @if ($errors->has('echec'))
            <p class="connexion-erreur connexion-erreur-general" role="alert">{{ $errors->first('echec') }}</p>
        @endif

        {{-- @method('PUT') : un formulaire HTML ne sait envoyer que GET ou POST, Laravel simule donc PUT --}}
        <form method="POST" action="{{ route('profil.envoyer') }}" class="connexion-form" novalidate>
            @csrf
            @method('PUT')

            {{-- old('champ', valeur_actuelle) : réaffiche la saisie en cas d'erreur, sinon la valeur enregistrée --}}

            {{-- Nom de famille : colonne "name" de la table users --}}
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" autocomplete="family-name">
            @error('name')
                <p class="connexion-erreur" role="alert">{{ $message }}</p>
            @enderror

            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" value="{{ old('prenom', auth()->user()->prenom) }}" autocomplete="given-name">
            @error('prenom')
                <p class="connexion-erreur" role="alert">{{ $message }}</p>
            @enderror

            <label for="adresse">Adresse</label>
            <input type="text" id="adresse" name="adresse" value="{{ old('adresse', auth()->user()->adresse) }}" autocomplete="street-address">
            @error('adresse')
                <p class="connexion-erreur" role="alert">{{ $message }}</p>
            @enderror

            <label for="code_postal">Code postal</label>
            <input type="text" id="code_postal" name="code_postal" value="{{ old('code_postal', auth()->user()->code_postal) }}" autocomplete="postal-code">
            @error('code_postal')
                <p class="connexion-erreur" role="alert">{{ $message }}</p>
            @enderror

            <label for="ville">Ville</label>
            <input type="text" id="ville" name="ville" value="{{ old('ville', auth()->user()->ville) }}" autocomplete="address-level2">
            @error('ville')
                <p class="connexion-erreur" role="alert">{{ $message }}</p>
            @enderror

            <label for="email">Adresse e-mail</label>
            <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" autocomplete="email">
            @error('email')
                <p class="connexion-erreur" role="alert">{{ $message }}</p>
            @enderror

            {{-- Le mot de passe n'est jamais pré-rempli, et reste inchangé si on laisse les champs vides --}}
            <label for="password">Nouveau mot de passe</label>
            <input type="password" id="password" name="password" autocomplete="new-password">
            <p class="connexion-aide">Laissez vide pour conserver votre mot de passe actuel.</p>
            @error('password')
                <p class="connexion-erreur" role="alert">{{ $message }}</p>
            @enderror

            <label for="password_confirmation">Confirmer le nouveau mot de passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password">

            <button type="submit" class="cookie-btn cookie-btn-accept connexion-btn">Enregistrer</button>
        </form>
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