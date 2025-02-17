**Le but n'est pas forcément de tout terminer**, mais d'aller le plus loin possible pour chacun.

# Pour tester si Pas la flemme
1. `git clone https://github.com/Alexandre-RICHARD/mds_laravel_boxon.git` 
2. `composer i`
3. `npm i`
4. Création du `.env` avec comme contenu ceci
```
CECI
```
5. Créer le fichier `database\database.sqlite`
6. `php artisan migrate:fresh --seed`
7. `php artisan serve` si utilisé de cette manière, sinon [http://localhost]
8. Identifiants : `kevin.niel@gmail.com` et `password`

## Les fonctionnalités

- [X] Authentification
- [X] Gestion de box (chaque compte utilisateur (= proprio de box) peut gérer ses propres box)
- [X] Gestion de locataires (nom, tel,mail, adresse, compte banciare...)
- [X] Gestion de modèles de contrats
- [] Gestion des contrats automatisée : l'utilisateur peut créer un modèle de contrat, en y incluant des variables (nom, prenom, adresse, etc...) qui seront par la suite automatiquement remplacées lors de la constitution d'un contrat.
- [] Gestion des suivis de paiement au mois par mois (ex: cases à cocher, champs date, etc...)
- [] Gestion des impots : Renseigner le montant total qu'une personne doit mettre dans sa déclaration d'impôts, et dans quelle case.
    - [] Régime micro-foncier : 
        - [] doit être inférieur à 15.000€ annuel
        - [] case 4 BE déclaration n°2042
        - [] Quel montant total je doit mettre dans cette case
        - [] Sur quel montant serais-je imposé ? (abattement de 30%) => doit faire le calcul et affiché 70% des revenus
    - [] Régime réel : 
        - [] obligatoire si supérieur à 15.000€ annuel
        - [] case 4 BA déclaration n°2044
        - [] Quel montant total je doit mettre dans cette case
        - [] Sur quel montant serais-je imposé ? => 100% des revenus
- [] Gestion des factures

## Les petits plus

- [] Export du contrat en PDF 😁 (merci kévin)
- [] Export des impôts en PDF (merci Yann)
- [] Export Excel comptable des paiements reçu
- [] Export des clients au format CSV
- [] Envoi automatique par mail de la facture 🐥

## Les impératifs

- [X] GIT & GITHUB (repo public)
- [X] Issues pour chaque chose réalisée
- [X] Milestones
- [X] Branches à gogo 🌴

## !!!!! Nouveauté - à faire avant VENDREDI SOIR !!!!!

- [X] A partir du moment où vous aurez mis en place le CI/CD, vous NE DEVREZ PLUS DÉVELOPPER SUR LA BRANCHE MAIN/MASTER. Vous devrez mettre en place une branche nommée `dev`. Chaque merge sur la branche master/main devra automatiquement déclencher le CI/CD et le déploiement.
- [X] Pour intégrer vos features en prod, vous devrez obligatoirement passer par la branche `dev`.

## Les livrables finaux

- Code source
- Script de déploiement automatique (CI/CD)
- URL d'accès à votre projet
- Readme - qui inclura des logs de connexion par défaut pour tester l'application !

# Etapes de réalisation

1. ✅ Initialisation de Laravel
2. ✅ Mise en place de l'authentification (cf breeze : https://laravel.com/docs/11.x/starter-kits#laravel-breeze)
3. ✅ Gestion des boxs (CRUD : https://github.com/kevinniel/MDS-B3-2425-LARAVEL?tab=readme-ov-file#etapes-dun-crud)
4. ✅ Gestion des locataires (= boxs !)
5. ✅ Gestion des modèles de contrats (= CRUD !) (6)
6. Gestion des contrats (3)
7. Gestion des factures (5) ==> creation uniquement...
8. Gestion des paiements (1)
9. Gestion des impots (2)
10. Bonus (1)

# Déploiement & CI/CD

## Déploiement

Sur le VPS : 

- `sudo apt update && sudo apt upgrade -y` mettre à jour les paquets
- `sudo apt install -y nginx php-cli php-fpm php-sqlite3 php-xml php-mbstring php-curl php-zip unzip git composer sqlite3` installation des paquets pour le déploiement de laravel
- modification du fichier `/etc/nginx/sites-enabled/default` : ajout de `index.php` sur la ligne des index
- restart le service nginx : `sudo service nginx restart`
- se positionner dans le bon dossier `cd /var/www/html`
- cloner le repo dans le dossier `sudo git clone [URL] .`
- installer les dépendances de laravel avec composer : `composer install`
- vérifier l'installation de php-fpm (`sudo apt install php8.2-fpm -y`)
- Configurer le `.env` (`sudo cp .env.example .env`)
- regénérer la clé dans le .env (`php artisan key:generate`)
- Modifiez le fichier de conf default de nginx (`/etc/nginx/sites-available/default`) -> cf gros bout de code ci-dessous
- vérifier les droits sur les fichiers : 
```
sudo chown -R www-data:www-data /var/www/html
sudo chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
```
- Créer le fichier SQLite, et donner les droits adéquats dessus :
```
touch /var/www/html/database/database.sqlite
sudo chown www-data:www-data /var/www/html/database/database.sqlite
sudo chmod 664 /var/www/html/database/database.sqlite
```
- Déclencher la migration (`php artisan migrate`)
- il reste à build les dépendances Front via NPM. Installer NPM
```
sudo apt install nodejs npm -y
npm install
npm run build
```

## Default Nginx conf file

```
server {
    listen 80;
    server_name _; # Change avec ton domaine si nécessaire
    root /var/www/html/public;
    index index.php index.html index.htm;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    # Configuration pour PHP-FPM
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;  # Vérifie la version de PHP installée
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    # Interdire l'accès aux fichiers cachés (ex: .env)
    location ~ /\. {
        deny all;
    }
}
```

## Mise en place du CI/CD

Plusieurs étapes à suivre : 

1. créer un fichier `.github/workflows/ci.yml` à la racine de votre projet
2. y coller le contenu de base fourni ci-dessous (ci.yml)
3. Aller paramétrer les variables d'environnement dans github
    - aller dans "settings", "Secret & Variables", "Actions"
    - dans l'onglet "Secrets", aller à "New repository secret"
    - Créer les 4 variables nécessaires


### Contenu de base du ci.yml

```
name: CI

on: [push]

jobs:
    deploy:
        if: github.ref == 'refs/heads/master'
        runs-on: ubuntu-latest
        steps:
        - uses: actions/checkout@v2
        - name: Push to server
            uses: appleboy/ssh-action@master
            with:
            host: ${{ secrets.SERVER_IP }}
            username: ${{ secrets.SERVER_USERNAME }}
            password: ${{ secrets.SERVER_PASSWORD }}
            script: |
                cd ${{ secrets.PROJECT_PATH }}
```

## Tests & coverage

```
vendor/bin/pest --coverage-html=build/coverage
```
