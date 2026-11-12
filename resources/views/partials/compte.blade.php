@auth
    <li class="compte">
        <span class="compte-bienvenue">Bienvenue, {{ auth()->user()->prenom }}</span>
        <form method="POST" action="{{ route('deconnexion') }}" class="compte-form">
            @csrf
            <button type="submit" class="compte-lien">Se déconnecter</button>
        </form>
    </li>
@else
    <li class="compte"><a href="{{ route('connexion') }}">Se connecter</a></li>
@endauth
