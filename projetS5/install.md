
## Procédure d'installation du projet laravel sur votre machine

Ce document vous donne toutes les instructions nécessaires pour configurer le projet laravel sur votre machine.
 
### All systems (Linux, Mac OS X, and Windows)


1.Cloner tout le projet.

    ouvrir un terminal dans le repertoire ou vous voulez mettre le projet et écrivez ;
    
    ```
    git clone https://forge.univ-artois.fr/tiente.hsu/GestionEtudiants2018.git
    ```

2.Configurez votre base de données dans le fichier .env du projet (renommer le .env.example en .env si il n'est pas présent).

    Ligne à modifier selon le sgbd utilisé
    
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=homestead
    DB_USERNAME=homestead
    DB_PASSWORD=secret
    ```
    
3.Installez les différents modules utilisées dans le projet.

 ```
 composer install
 composer update
  ```
  
4.Créer les différentes tables SQL du projet dans votre sgbd.

  
    php artisan migrate:fresh 
    (supprime et recréer toutes les tables utilisées).
  
          
5.Lancer le serveur du projet 

  
    php artisan serve
  