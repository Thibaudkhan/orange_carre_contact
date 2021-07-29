# Orange_carre_contact
Symfony

##Before the installation
<p> Check the .env file, you need to write your user and password for mysql connection.</p>
<p> Check the .env file, you need to write your mail and password for mailer DSN</p>
<p>Clone the project and use the development branch </p>

##Command to install the project

* ``php composer.phar update``
* ``php bin/console doctrine:database:create``


##Install manually dependencies 
* ``composer require symfony/mailer``
* ``composer require symfony/orm-pack``
* ``composer require --dev symfony/maker-bundle``


##Run the server 
* ``symfony server:start``