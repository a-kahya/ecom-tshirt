{{-- Bloc "compte" de la nav : inclus dans toutes les pages, il s'adapte à l'état de connexion --}}

{{-- Affiché uniquement si l'utilisateur est connecté --}}
@auth
    <li class="compte">
        {{-- US6 : le message de bienvenue mène au profil, depuis n'importe quelle page --}}
        <a href="{{ route('profil') }}" class="compte-bienvenue">Bienvenue, {{ auth()->user()->prenom }}</a>

        {{-- US7 : déconnexion en POST, @csrf ajoute le jeton de sécurité --}}
        <form method="POST" action="{{ route('deconnexion') }}" class="compte-form">
            @csrf
            <button type="submit" class="compte-lien">Se déconnecter</button>
        </form>
    </li>
{{-- Affiché pour un visiteur non connecté --}}
@else
    <li class="compte">
        <a href="{{ route('connexion') }}">Se connecter</a>
        <a href="{{ route('inscription') }}">S'inscrire</a>
    </li>
@endauth