@extends('legal.layout')

@section('titre', 'Politique de cookies')

@section('contenu')
<aside class="legal-resume">
    <strong>En bref</strong>
    <p>
        TeeShop n'utilise que les cookies indispensables à son fonctionnement. Aucun cookie publicitaire,
        aucun suivi de votre navigation. Vous gardez la main sur votre choix et pouvez le modifier à tout moment.
    </p>
</aside>

<section>
    <h2>1. Un cookie, c'est quoi ?</h2>
    <p>
        Un cookie est un petit fichier déposé sur votre appareil lorsque vous visitez un site. Il permet par
        exemple de reconnaître votre navigation d'une page à l'autre, ou de retenir une préférence.
    </p>
</section>

<section>
    <h2>2. Ceux que nous utilisons</h2>
    <table class="legal-table">
        <thead>
            <tr><th>Nom</th><th>À quoi il sert</th><th>Durée</th><th>Votre accord</th></tr>
        </thead>
        <tbody>
            <tr>
                <td>Cookie de session</td>
                <td>Maintenir votre navigation et votre panier d'une page à l'autre</td>
                <td>Durée de la session</td>
                <td>Non requis (indispensable)</td>
            </tr>
            <tr>
                <td>XSRF-TOKEN</td>
                <td>Protéger les formulaires contre les envois frauduleux</td>
                <td>Durée de la session</td>
                <td>Non requis (indispensable)</td>
            </tr>
            <tr>
                <td>Choix cookies</td>
                <td>Mémoriser votre réponse au bandeau (stockée dans votre navigateur)</td>
                <td>Jusqu'à ce que vous l'effaciez</td>
                <td>Non requis (c'est votre préférence)</td>
            </tr>
        </tbody>
    </table>
    <p>
        Nous n'utilisons <strong>aucun cookie de mesure d'audience, de publicité ou de réseau social</strong>.
        Si cela devait changer, nous vous demanderions votre accord avant tout dépôt.
    </p>
</section>

<section>
    <h2>3. Modifier votre choix</h2>
    <p>
        Vous pouvez revenir sur votre décision à tout moment avec le bouton ci-dessous, ou via le lien
        « Gérer mes cookies » en bas de chaque page.
    </p>
    <p><button type="button" class="cookie-btn cookie-btn-accept" data-cookie-settings>Gérer mes cookies</button></p>
</section>

<section>
    <h2>4. Depuis votre navigateur</h2>
    <p>
        Vous pouvez aussi supprimer ou bloquer les cookies dans les réglages de votre navigateur. Attention :
        bloquer les cookies indispensables peut empêcher le panier ou certaines pages de fonctionner.
    </p>
</section>

<section>
    <h2>5. Pour aller plus loin</h2>
    <p>
        Le traitement de vos données personnelles est expliqué dans notre
        <a href="{{ route('legal.confidentialite') }}">politique de confidentialité</a>.
    </p>
</section>
@endsection
