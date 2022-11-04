# SnowTricks
 OpenClassRoom - Dev PHP - Projet 6 - Développez de A à Z le site communautaire SnowTricks
​
# Require
​
- Symfony 6 (and CLI)
- MySQL 8
- Composer
​
# Lancer le projet
​
Cloner le projet, installer les dépendances
Modifier le .env selon votre configuration
​
```bash
brew install symfony-cli/tap/symfony-cli (mac OS)
git clone https://github.com/Cpasklaire/SnowTricks.git SnowTricks
cd SnowTricks
composer install
cp .env.example .env
vi .env
```
​
Préparer la base de données
​
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
symfony server:start
​
​
# Thanks
​
- picture => vecteezy.com
- bootstrap theme => sketchy by Thomas Park.
- [![Codacy Badge](https://app.codacy.com/project/badge/Grade/c904a2bc59f040c09f9f648393a451f8)](https://www.codacy.com/gh/Cpasklaire/SnowTricks/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Cpasklaire/SnowTricks&amp;utm_campaign=Badge_Grade)
​
​
# Helpful reminders
​
commande 
```bash
​
symfony server:start
​
php bin/console make:controller
php bin/console make:form
​
php bin/console doctrine:database:create
php bin/console make:entity
php bin/console make:migration   //puch
php bin/console doctrine:migrations:migrate     //puch
​
php bin/console make:fixtures
écrire la fixure
php bin/console doctrine:fixtures:load
​
php bin/console debug:autowiring --all //les service possible
```