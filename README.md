# HelloCSE

ceci est une mini API de helloCSE;

## installation

Clone le projet depuis ce repo avec la commande `git clone ` dans un dossier.

Placez-vous ensuite dans le projet  `cd *nom du dossier*`

Une fois dans le dossier dans le terminal taper la commande `docker-compose run --rm composer install` afin d'installer les dependence du projet.
Ensuite placer vous dans le dossier `src` copier le fichier `.env.exemple`et renommer le en `.env`.
Dans le fichier.env.exemple copier et coller le block suivant dans le fichier .env :

```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=helloCSE_DB
DB_USERNAME=homestead
DB_PASSWORD=secret

```
Vu que nous sommes dans un environnement docker je me permets de donner des fausses informations de base de données.

DB_CONNECTION=mysql, 'mysql' ici correspond au service (conteneur) mysql qu'on peut voir dans le fichier docker-compose.yml à la racine du projet ainsi que le mot de passe (DB_PASSWORD) et le username (DB_USERNAME) tous definit dans le docker-compose.yml dans le service (conteneur) mysql.

Ensuite taper la commande `docker-compose run --rm artisan key:generate` afin de générer une clé unique pour notre application.


Si le dossier "mysql" est présent à la racine de votre projet supprimer le.

Une fois la clé générée, taper la commande `docker-compose up --build -d nginx` pour lancer vos conteneurs pour l'api. Ensuite taper la commande `docker-compose ps` pour voir si vos conteneurs tournent bien. Vous pouvez tester l'api sur l'endpoint `http://localhost/api/v1/test. Vous devriez avoir un retour si vous êtes connecté à l'api.

# RUN les migrations

Une fois vos conteneurs en marche, taper la commande `docker compose run --rm artisan migrate` afin de lancer les migrations vers votre base de données.
Après les migrations lancer les seeders afin de peupler notre base de données avec la commande `docker compose run --rm artisan db:seed`.
et pour lancer les test la commande `docker-compose --rm artisan test`

# PHP MY ADMIN

L'accès à PHpMyadmin est sur le port 2023 et donc sur le lien : http://localhost:2023.

username : homestead
password : secret

# La documentation des endpoints de l'API

Pour voir les routes (endpoints) que vous pouvez utiliser, vous pouvez avoir accès si vos conteneurs sont en marche sur le lien : <a href="http://localhost:3002/docs/index.html">
voir la doc.
</a>

ou (http://localhost:3002/docs)


# En cas de probleme de cache BDD

- `docker compose run --rm artisan cache:clear`
- `docker compose run --rm artisan config:clear`
