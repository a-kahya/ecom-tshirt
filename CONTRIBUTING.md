# Travailler à plusieurs sur le dépôt

Équipe de 3 sur ce projet Laravel (TeeShop). Ces règles évitent les conflits et
gardent `main` toujours utilisable.

## Les branches

- `main` : version stable, celle qu'on présente. On ne code pas dessus
  directement : on n'y fusionne que des branches terminées.
- **Une branche par user story**, créée depuis `main` à jour :
  - `feature/us1-accueil`
  - `feature/us2-catalogue-produits`
  - `feature/us3-detail-produit`
- Pas de branche « base de données » ou « front » : une fonctionnalité touche
  toutes les couches, elle doit rester complète dans une seule branche.

## Le cycle de travail

1. Récupérer `main` à jour :
   ```bash
   git checkout main
   git pull
   ```
2. Créer sa branche :
   ```bash
   git checkout -b feature/usX-nom-court
   ```
3. Commiter souvent, un commit = une idée (voir plus bas).
4. Rester à jour avec `main` pour régler les conflits tôt :
   ```bash
   git pull origin main
   ```
5. Pousser la branche, ouvrir une **pull request** vers `main`, la faire relire
   par un camarade, puis fusionner et supprimer la branche.

## Les messages de commit

Une première ligne courte au présent, qui dit ce que ça fait, suivie si besoin
d'une description :

```
US3 : ajout de la page détail d'un produit

- vue produit.blade.php (nom, marque, prix, image)
- lien depuis les cartes de l'accueil et de la catégorie
```

## Les fichiers sensibles aux conflits

| Fichier | Précaution |
|---|---|
| `routes/web.php` | Ajouter ses routes, ne pas réorganiser celles des autres. `pull` souvent. |
| `resources/css/app.css` | Un bloc commenté par page. Ne pas modifier les blocs des autres. |
| `database/` | Voir la section suivante. |

## La base de données

- Le schéma de référence est celui de `database/ecom_tshirt_database.sql` :
  - `categories` : `id`, `description`
  - `products` : `id`, `nom`, `marque`, `prix`, `image`, `category_id`
- **Ne changer le schéma qu'après accord de l'équipe**, et le dire à tout le
  monde : une colonne renommée casse les pages des autres.
- Chaque évolution du schéma passe par une migration ou une mise à jour du
  fichier SQL, commitée dans la même branche que la fonctionnalité.

## À ne jamais commiter

- `.env` (déjà ignoré) : chacun a le sien.
- `vendor/`, `node_modules/`, `public/build/` (déjà ignorés).
- Des mots de passe, clés ou fichiers personnels.
- Jamais de `git push --force` sur une branche partagée.

## Installer le projet sur son PC

Prérequis : PHP 8.4 ou plus, Composer, Node.js, MySQL.

```bash
git clone https://github.com/a-kahya/ecom-tshirt.git
cd ecom-tshirt
composer install
cp .env.example .env
php artisan key:generate
npm ci
npm run build
```

Importer `database/ecom_tshirt_database.sql` dans MySQL (phpMyAdmin >
Importer), puis lancer :

```bash
php artisan serve
```
