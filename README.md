ReUzze Frontoffice - Symfony Project
========================

This is the repository of the frontoffice of the Reuzze project. Below you can find the several steps for deployment.

1) Installing the Database
----------------------------------

The database model and SQL file can be found at the following directory:

    reuzze/src/Reuzze/ReuzzeBundle/Database

You can also import some basic data like categories, regions and roles. The SQL for that can be found in the same directory of above. 


1) Installing the Project
----------------------------------

### Use Composer

For installing the project we use [Composer][1] to manage its dependencies.

To update the project execute the following commands in the root of the webapplication:

    php composer.phar update
    php app/console assets:install --symlink
    
The terminal will ask for your configuration settings.

2) Revise your Database Configuration
-------------------------------------

You can revise your database configuration in the file that can be found at the following directory:

    reuzze/app/config/parameters.yml

Or by going to the following link : 

    reuzze/web/config.php

3) Browsing the Symfony Application
--------------------------------

You're now ready to use the Symfony Project.

To go to the homepage go to the following link:

    reuzze/web/app_dev.php/


[1]:  http://getcomposer.org/
