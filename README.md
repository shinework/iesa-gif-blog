# TP: créer un GIF Blog avec Symfony2

Slides cours:

 - [Jour 1](shinework.io/iesa/cours-jour1.pdf)
 - [Jour 2](shinework.io/iesa/cours-jour2.pdf)
 - Jour 3

### 1 - Installer Symfony via Composer

#### Composer
Normalement vous devriez tous avoir un composer (installer en global ou en local composer.phar)

**Référence slide**: slide 29 - jour 1

#### Installer Symfony


**Référence slide**: slide 32 - jour 1

[Documentation Symfony](https://symfony.com/doc/master/book/installation.html#creating-symfony-applications-without-the-installer)


Attention à bien installer la version 2.8 (bien mettre le `"~2.8.0"`, la version 3 n'est pas encore compatible avec tous les bundles)

Pensez à changer le `my_project_name` par le nom du répertoire que vous voulez. 
```
composer create-project symfony/framework-standard-edition my_project_name "~2.8.0"
```
Lorsque que composer vous y invite ('Some parameters are missing. Please provide them"), renseignez les identifiants de votre base de donnée (`database_host`, `database_port` …), pour les autres paramètres (mailer_xxx, secret) vous pouvez laisser les valeurs par défaut.

Vous pouvez lancer un serveur Symfony (si vous n'avez pas déjà un serveur MAMP ou autre qui tourne) depuis la console (placez vous dans le répertoire de votre projet: le dossier `my_project_name` créé plus tôt):

```
php app/console server:run
```
[Documentation Symfony sur cette commande](http://symfony.com/doc/current/cookbook/web_server/built_in.html)

**Attention**: cette commande est bloquante, vous devez ouvrir une autre console pour pouvoir taper des commandes.

Vous avez maintenant un site tournant avec Symfony à l'adresse http://127.0.0.1:8000 et tomber sur la page d'accueil "Welcome to Symfony"

### 2 - Nettoyer le projet

Lorsque l'on installe Symfony du code inutile (dans notre cas) est généré, commencez par supprimer:

 - les fichiers `UPGRADE.md, UPGRADE-2.2.md, UPGRADE-2.3.md, UPGRADE-2.4.md, UPGRADE-2.8.md`
 - le dossier `src/AppBundle/Tests`

### 3 - Créer la structure du site

**Référence slide** 

 - **Le routing:** slide 77 - jour 1 
 - **Les contrôleurs:** slide 85 - jour 1

Nous voulons créer un blog disposant de plusieurs pages:

**Page public**

Page d'accueil 
`/` 
>Liste les posts (contenant un titre et un lien de GIF), cette page dispose d'une pagination et afficher uniquement 20 GIF par page.

**Pages admin (protégé par identification passe)**
 
Ajout de post 
`/admin/list` 
> Page permettant l'ajout d'un post.

Liste des posts  
`/admin/add`
>Page listant tout les posts du site et permettant des les supprimer.

Renommez le `DefaultController.php` en `BlogController.php`, n'oubliez pas de renommer le nom de la classe également. Le contrôleur contient déjà la page d'accueil.

Ajoutez le contrôleur à votre AppBundle pour les pages d'administrations `AdminController.php`  grâce à la commande:

```
php app/console generate:controller
```

[Documentation de la commande](http://symfony.com/doc/current/bundles/SensioGeneratorBundle/commands/generate_controller.html)

Ce contrôleur dispose de deux actions `addAction` et `listAction` (à indiquer lorsque la commande vous le demande) correspondant au deux pages indiquées plus haut. Lorsque la commande vous demande le noms des routes utiliser comme route `/admin/add` et  `/admin/list`.

La commande va automatique créer les fichiers de templates associés:

 - src/AppBundle/Resources/views/Admin/add.html.twig
 - src/AppBundle/Resources/views/Admin/list.html.twig

Vouas avez maintenant trois pages actives:

 - http://127.0.0.1:8000/
 - http://127.0.0.1:8000/admin/list
 - http://127.0.0.1:8000/admin/add

Changer le template de la page d'accueil pour qu'il pointe vers votre propre template (`src/AppBundle/Resources/views/Blog/index.html.twig`) et non plus vers `app/Resources/views/default/index.html.twig` que vous pouvez supprimer.

Documentation: [Créer sa première page sur Symfony](http://symfony.com/doc/2.8/book/page_creation.html)

