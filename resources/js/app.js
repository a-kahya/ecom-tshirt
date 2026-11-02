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
