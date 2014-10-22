#webprog#
Regionales News-Portal mit Yii, Bootstrap und jQuery


##Installation##
- clone this repository
- use **sqlscripts/create_database.sql** (does what expected)
- download Yii 2.0 (http://www.yiiframework.com/download/)
- insert **vendor/** folder into project

##CRUD-Generator##
Is used to easily create models, views and controllers

http://path/to/project/web/index.php?r=gii

##CKEditor##
http://docs.ckeditor.com/#!/guide

##Composer##
- Install Composer on Windows: https://getcomposer.org/Composer-Setup.exe
- Get Composer Installer via PHP:
    - In cmd:
        - cd C:\xampp\htdocs\...\webprog
        - php -r "readfile('https://getcomposer.org/installer');" | php
        - php composer.phar install
- CKEditor should be installed in /vendor/2amigos and /vendor/ckeditor
- Maybe not every step has to be done, since the composer.phar already was downloaded

https://getcomposer.org/doc/00-intro.md

##Migrations##
- In cmd:
    - cd C:\xampp\htdocs\...\webprog
    - yii migrate/create [meaningful_name_of_what_your_migration_does]
- Edit functionality in /migrations/....php
- In cmd again:
    - yii migrate

http://www.yiiframework.com/doc-2.0/guide-db-migrations.html
