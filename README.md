# SnowTricks
 OpenClassRoom - Dev PHP - Projet 6 - Développez de A à Z le site communautaire SnowTricks

# Require
Symfony 6
MySQL 8
Composer

# Lancer le projet
Cloner le repertoir.
Modifier le .env selon votre configuration

Dans votre console 
'''
php bin/console doctrine:database:create
php bin/console doctrine:fixtures:load
symfony server:start
'''

# Thanks you
picture => vecteezy.com
bootstrap theme => sketchy by Thomas Park.



# Memory perso
commande 
'''shell
symfony server:start

php bin/console make:controller
php bin/console make:form

php bin/console doctrine:database:create
php bin/console make:entity
php bin/console make:migration   //puch
php bin/console doctrine:migrations:migrate     //puch

php bin/console make:fixtures
écrire la fixure
php bin/console doctrine:fixtures:load

php bin/console debug:autowiring --all //les service possible
'''