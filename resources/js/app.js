// Bandeau cookies : le choix est mémorisé dans le navigateur (obligations légales)
(function () {
    const KEY = 'teeshop_cookies';
    const banner = document.getElementById('cookie-banner');
    if (!banner) return;

    const read = () => {
        try { return localStorage.getItem(KEY); } catch (e) { return null; }
    };
    const write = (value) => {
        try { localStorage.setItem(KEY, value); } catch (e) { /* stockage indisponible */ }
    };

    if (!read()) banner.hidden = false;

    banner.querySelectorAll('[data-cookie-choice]').forEach((btn) => {
        btn.addEventListener('click', () => {
            write(btn.dataset.cookieChoice);
            banner.hidden = true;
        });
    });

    document.querySelectorAll('[data-cookie-settings]').forEach((btn) => {
        btn.addEventListener('click', () => { banner.hidden = false; });
    });
})();

// Indicateur de force du mot de passe (formulaire d'inscription)
(function () {
    const champ = document.getElementById('password');
    const meter = document.getElementById('password-meter');
    if (!champ || !meter) return;

    const barre = meter.querySelector('.meter-barre');
    const texte = meter.querySelector('.meter-texte');
    const niveaux = [
        { libelle: 'Faible', classe: 'meter-faible' },
        { libelle: 'Faible', classe: 'meter-faible' },
        { libelle: 'Moyen', classe: 'meter-moyen' },
        { libelle: 'Bon', classe: 'meter-bon' },
        { libelle: 'Fort', classe: 'meter-fort' },
    ];

    champ.addEventListener('input', () => {
        const v = champ.value;
        meter.hidden = v === '';
        const score = [
            v.length >= 8,
            /\p{Lu}/u.test(v),
            /\d/.test(v),
            /[^\p{L}\d\s]/u.test(v),
        ].filter(Boolean).length;

        const { libelle, classe } = niveaux[score];
        barre.style.width = Math.max(score, 1) * 25 + '%';
        barre.className = 'meter-barre ' + classe;
        texte.textContent = 'Force du mot de passe : ' + libelle;
    });
})();
