@auth
    <li class="compte">
        <span class="compte-bienvenue">Bienvenue, {{ auth()->user()->prenom }}</span>
    </li>
@else
    <li class="compte">
        <a href="{{ route('connexion') }}">Se connecter</a>
        <a href="{{ route('inscription') }}">S'inscrire</a>
    </li>
@endauth
