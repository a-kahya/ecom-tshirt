@extends('legal.layout')

@section('titre', 'Conditions générales de vente')

@section('contenu')
<aside class="legal-resume">
    <strong>En bref</strong>
    <p>
        Vous avez 14 jours après réception pour changer d'avis, sans avoir à vous justifier.
        Vos articles sont garantis 2 ans contre les défauts. Le droit belge s'applique.
    </p>
</aside>

<section>
    <h2>1. Qui vend ?</h2>
    <p>
        TeeShop, projet réalisé dans le cadre du cours « Projet d'intégration de développement » (EAFC Uccle).<br>
        12 rue des Tisserands, 1000 Bruxelles, Belgique.<br>
        E-mail : <a href="mailto:contact@teeshop.example">contact@teeshop.example</a><br>
        Numéro d'entreprise : BE 0000.000.000 (fictif, à des fins pédagogiques)
    </p>
</section>

<section>
    <h2>2. À qui s'appliquent ces conditions ?</h2>
    <p>
        À toute commande passée sur ce site par un consommateur, c'est-à-dire une personne qui achète pour un
        usage non professionnel. En commandant, vous confirmez les avoir lues et acceptées.
    </p>
</section>

<section>
    <h2>3. Nos produits</h2>
    <p>
        Nous présentons nos vêtements avec soin : nom, marque, prix et photographie. De légères différences de
        couleur peuvent exister selon votre écran. Les articles sont proposés dans la limite des stocks disponibles.
    </p>
</section>

<section>
    <h2>4. Prix</h2>
    <p>
        Les prix sont en euros, toutes taxes comprises (TVA incluse). Les frais de livraison éventuels sont
        indiqués avant la validation de la commande. Le prix applicable est celui affiché au moment où vous commandez.
    </p>
</section>

<section>
    <h2>5. Passer commande</h2>
    <ol>
        <li>Vous choisissez vos articles et les ajoutez au panier.</li>
        <li>Vous vérifiez le récapitulatif (articles, prix, livraison).</li>
        <li>Vous validez et réglez : la commande est alors ferme.</li>
        <li>Nous vous envoyons un e-mail de confirmation.</li>
    </ol>
    <p>
        Nous pouvons refuser ou annuler une commande en cas d'article indisponible, d'erreur manifeste de prix
        ou de suspicion de fraude. Vous êtes alors remboursé intégralement.
    </p>
</section>

<section>
    <h2>6. Paiement</h2>
    <p>
        Le paiement est dû à la commande, par les moyens proposés sur le site. Les transactions sont réalisées
        via un prestataire de paiement sécurisé : TeeShop ne conserve pas vos données bancaires.
    </p>
</section>

<section>
    <h2>7. Livraison</h2>
    <p>
        Nous livrons à l'adresse indiquée lors de la commande, en Belgique. Le délai annoncé est donné à titre
        indicatif. En cas de retard important, vous pouvez nous contacter ; si la livraison n'a pas eu lieu
        dans un délai supplémentaire raisonnable que vous nous fixez, vous pouvez annuler la commande et être remboursé.
    </p>
    <p>Vérifiez votre colis à la réception et signalez-nous toute anomalie dans les meilleurs délais.</p>
</section>

<section>
    <h2>8. Changer d'avis : le droit de rétractation</h2>
    <p>
        Vous disposez de <strong>14 jours</strong> à partir de la réception de votre commande pour vous rétracter,
        sans avoir à donner de raison.
    </p>
    <ul>
        <li><strong>Comment ?</strong> En nous écrivant à <a href="mailto:contact@teeshop.example">contact@teeshop.example</a> pour nous le notifier clairement.</li>
        <li><strong>Que renvoyer ?</strong> Les articles dans leur état d'origine, non portés et non lavés, avec leurs étiquettes, dans les 14 jours suivant votre notification.</li>
        <li><strong>Les frais de retour</strong> sont à votre charge.</li>
        <li><strong>Le remboursement</strong> intervient au plus tard 14 jours après que nous avons reçu votre notification, par le même moyen de paiement que celui utilisé pour la commande. Nous pouvons attendre la réception du colis ou la preuve de son renvoi.</li>
    </ul>
    <p>
        Ce droit ne s'applique pas aux articles personnalisés ou confectionnés selon vos spécifications.
    </p>
</section>

<section>
    <h2>9. Garantie légale de conformité</h2>
    <p>
        Tous nos articles sont couverts par la garantie légale de conformité de <strong>2 ans</strong> à compter de la
        livraison. Si un article présente un défaut qui existait au moment de la livraison, vous pouvez obtenir sa
        réparation, son remplacement, une réduction du prix ou, à défaut, un remboursement. Contactez-nous avec une
        photo et votre numéro de commande.
    </p>
</section>

<section>
    <h2>10. Notre responsabilité</h2>
    <p>
        Nous sommes responsables des dommages qui résultent de notre faute, dans les limites prévues par la loi.
        Nous ne sommes pas responsables des interruptions du site dues à des causes extérieures (panne de réseau,
        maintenance, cas de force majeure).
    </p>
</section>

<section>
    <h2>11. Vos données personnelles</h2>
    <p>
        Nous utilisons vos données uniquement pour traiter votre commande et vous servir. Tous les détails sont
        dans notre <a href="{{ route('legal.confidentialite') }}">politique de confidentialité</a>.
    </p>
</section>

<section>
    <h2>12. Une question ou un litige ?</h2>
    <p>
        Écrivez-nous d'abord : la plupart des difficultés se règlent simplement. À défaut d'accord, vous pouvez
        saisir le Service de médiation pour le consommateur (<a href="https://www.mediationconsommateur.be" rel="noopener" target="_blank">mediationconsommateur.be</a>).
    </p>
    <p>
        Les présentes conditions sont soumises au droit belge. En cas de litige, les tribunaux de Bruxelles sont
        compétents, sans préjudice des règles protégeant le consommateur.
    </p>
</section>
@endsection
