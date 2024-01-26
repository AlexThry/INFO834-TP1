# INFO834 - TP1

## Dépendences 

### Python

Le projet est fournis avec une version de python compatible.

Pour modifier le temps à attendre en cas de trop nombreuses connexions, changer la variable `time_to_wait` dans le script `py_redis.py`.

### Redis

Une version de redis fonctionnelle est nécéssaire pour utiliser le projet. 

### PHPMyAdmin (Xampp / Wampp / ...)

Le projet utilise PHP My Admin pour stocker les informations sur les utilisateurs. Il faut donc utiliser soit: 
- La base de donnée de l'école
- Une base de donnée locale


Dans les deux cas, il faut une table `USERS` avec deux colonnes `email` et `password`.

Dans le fichier `header.php`, il faut modifier les informations concernant la connexion à la base de donnée.

## Lancement

### Redis

Lancer redis dans un terminal avec `redis-server --port 6379` puis un client dans un autre terminal avec `redis-cli`. Dans le client, ajouter des produits de la catégorie 1 avec `set product:1:quantity 10` et de la catégorie 2 avec `set product:2:quantity 10`.

Ces commandes servent à ajouter du stock dans la base de donnée pour pouvoir utiliser les fonctionnalités du site. 

### Seveur

**Espace personnel université** : Place le dossier du projet dans le dossier `public_html`

**Xampp** : Place le dossier du projet dans le dossier `htdocs` de Xampp, ou équivalent à public_html

## Application

L'application comporte une page de login, une page d'enregistrement et un page d'acceuil sur laquelle un utilisateur peut acheter/vendre des objets.

Les achats/ventes sont réalisés à l'aide de transaction pour éviter le double spending. 






