@extends('legal.layout')

@section('titre', 'Politique de confidentialité')

@section('contenu')
<aside class="legal-resume">
    <strong>En bref</strong>
    <p>
        Nous ne collectons que ce qui sert à préparer et livrer votre commande. Nous ne vendons jamais vos données.
        Vous pouvez les consulter, les corriger ou les faire effacer à tout moment en nous écrivant.
    </p>
</aside>

<section>
    <h2>1. Qui est responsable de vos données ?</h2>
    <p>
        TeeShop, projet réalisé dans le cadre du cours « Projet d'intégration de développement » (EAFC Uccle).<br>
        12 rue des Tisserands, 1000 Bruxelles, Belgique.<br>
        Contact : <a href="mailto:contact@teeshop.example">contact@teeshop.example</a>
    </p>
</section>

<section>
    <h2>2. Quelles données collectons-nous ?</h2>
    <ul>
        <li><strong>Pour passer commande</strong> : nom, prénom, adresse de livraison et de facturation, adresse e-mail, numéro de téléphone.</li>
        <li><strong>Pour votre compte</strong> (si vous en créez un) : identifiant et mot de passe (conservé sous forme chiffrée).</li>
        <li><strong>Pendant votre visite</strong> : contenu de votre panier, pages consultées, type de navigateur et adresse IP.</li>
        <li><strong>Vos préférences</strong> : votre choix concernant les cookies.</li>
    </ul>
    <p>Nous ne demandons jamais d'informations dont nous n'avons pas besoin, et jamais de données sensibles (santé, opinions, etc.).</p>
</section>

<section>
    <h2>3. Pourquoi, et sur quelle base légale ?</h2>
    <table class="legal-table">
        <thead>
            <tr><th>Ce que nous faisons</th><th>Pourquoi nous en avons le droit</th></tr>
        </thead>
        <tbody>
            <tr><td>Traiter, expédier et suivre votre commande</td><td>L'exécution du contrat de vente</td></tr>
            <tr><td>Établir les factures et tenir la comptabilité</td><td>Une obligation légale</td></tr>
            <tr><td>Sécuriser le site et lutter contre la fraude</td><td>Notre intérêt légitime</td></tr>
            <tr><td>Répondre à vos questions</td><td>Votre demande</td></tr>
            <tr><td>Vous envoyer des offres (si vous le souhaitez)</td><td>Votre consentement, retirable à tout moment</td></tr>
        </tbody>
    </table>
</section>

<section>
    <h2>4. Combien de temps gardons-nous vos données ?</h2>
    <ul>
        <li><strong>Données de commande et factures</strong> : 7 ans, conformément aux règles comptables.</li>
        <li><strong>Compte client</strong> : tant que votre compte est actif, puis supprimé après 3 ans d'inactivité.</li>
        <li><strong>Messages envoyés au service client</strong> : 2 ans après la dernière réponse.</li>
        <li><strong>Panier non finalisé</strong> : quelques jours, le temps de la session.</li>
    </ul>
</section>

<section>
    <h2>5. Qui reçoit vos données ?</h2>
    <p>
        Uniquement les personnes et prestataires dont nous avons besoin pour vous servir : l'équipe TeeShop,
        l'hébergeur du site, le prestataire de paiement et le transporteur. Chacun ne reçoit que ce qui est
        nécessaire à sa mission. Nous ne vendons ni ne louons vos données à des tiers.
    </p>
    <p>
        Nous privilégions des prestataires situés dans l'Union européenne. Si l'un d'eux se trouve en dehors,
        nous veillons à ce que des garanties adaptées protègent vos données.
    </p>
</section>

<section>
    <h2>6. Vos droits</h2>
    <p>Vous pouvez à tout moment :</p>
    <ul>
        <li>savoir quelles données nous détenons sur vous et en obtenir une copie ;</li>
        <li>corriger des informations inexactes ;</li>
        <li>demander l'effacement de vos données, lorsque la loi ne nous oblige pas à les conserver ;</li>
        <li>limiter ou vous opposer à certains traitements ;</li>
        <li>récupérer vos données dans un format réutilisable (portabilité) ;</li>
        <li>retirer un consentement que vous aviez donné.</li>
    </ul>
    <p>
        Écrivez-nous à <a href="mailto:contact@teeshop.example">contact@teeshop.example</a> en précisant votre demande.
        Nous répondons dans un délai d'un mois. Pour votre sécurité, nous pouvons vous demander de justifier de votre identité.
    </p>
</section>

<section>
    <h2>7. Comment protégeons-nous vos données ?</h2>
    <p>
        La connexion au site est chiffrée, les mots de passe sont stockés sous forme chiffrée, et l'accès aux
        données est limité aux personnes qui en ont besoin. En cas de fuite susceptible de vous porter préjudice,
        nous vous en informons ainsi que l'autorité compétente.
    </p>
</section>

<section>
    <h2>8. Cookies</h2>
    <p>
        Le fonctionnement des cookies est détaillé dans notre <a href="{{ route('legal.cookies') }}">politique de cookies</a>.
    </p>
</section>

<section>
    <h2>9. Une réclamation ?</h2>
    <p>
        Si vous estimez que vos droits ne sont pas respectés, parlez-nous-en d'abord : nous ferons tout pour
        trouver une solution. Vous pouvez également saisir l'Autorité de protection des données
        (<a href="https://www.autoriteprotectiondonnees.be" rel="noopener" target="_blank">autoriteprotectiondonnees.be</a>).
    </p>
</section>

<section>
    <h2>10. Modifications de cette politique</h2>
    <p>
        Nous pouvons faire évoluer ce texte. La date de dernière mise à jour figure en haut de la page ;
        en cas de changement important, nous vous en informerons.
    </p>
</section>
@endsection
