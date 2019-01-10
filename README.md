# Aux paniers de Péko

Site e-commerce de ventes de fruits et légumes.

## Créé par 

    - Clément Besse
    - Lucie Garcia
    - Clément Peyronnet
    - Nicolas Lopez (Mais pas longtemps !)

## Installation

```bash
- git clone https://gitlab.com/internals-projects/beziers/Peko directory
- cd directory
- composer install
- mv .env.example .env
- php artisan key:generate
- Modifier le fichier .env avec vos informations de connexion
- composer dump-autoload
- php artisan migrate:fresh --seed (Linux)
- php artisan migrate:refresh --seed (Windows)
- php artisan storage:link
- Enjoy !
```

## Optimisation en production

```bash
- composer install --optimize-autoloader --no-dev
- Dans le fichier .env modifier APP_DEBUG à false 
- Dans le fichier .env moidfier APP_ENV en production
- php artisan config:cache
- php artisan route:cache
```

## Utilisation

```bash
Compte administrateur :

E-mail : admin@admin.com
Mot de passe : admin

Compte client :

E-mail : client1@client.com
Mot de passe : client1
```