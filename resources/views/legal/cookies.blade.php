@extends('legal.layout')

@section('titre', 'Politique de cookies')

@section('contenu')
<section>
    <h2>Cookies utilisés par le site</h2>
    <p>
        Le site utilise uniquement des cookies techniques de session, nécessaires à son fonctionnement.
        Aucun cookie de mesure d'audience ou publicitaire n'est déposé pour le moment.
    </p>
    <p class="legal-a-fournir">[Texte définitif à fournir par le client]</p>
</section>

<section>
    <h2>Gérer vos choix</h2>
    <p><button type="button" class="cookie-btn cookie-btn-accept" data-cookie-settings>Gérer mes cookies</button></p>
</section>
@endsection
