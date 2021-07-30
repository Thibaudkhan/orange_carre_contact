# Orange_carre_contact #

************
Symfony Project : Form Contact
************

## Before the installation ##
<p>Clone the project using main branch and change the branch to v1</p>
<p> Check the .env file, you need to write your user and password for mysql connection.</p>
<p> Check the .env file, you need to write your mail and password for mailer DSN</p>

************

## Command to install the project ##

##### Install dependencies #####
* ``composer install``
##### Create the database : #####
* ``php bin/console doctrine:database:create``
##### Create the table : #####
* ``php bin/console make:entity``
 
##### Prepare the migration : #####
* `` php bin/console make:migration`` 

##### Migrate if previous command succeed : #####
* ``  php bin/console doctrine:migrations:migrate`` 


************

## Install manually dependencies ##
* ``composer require symfony/mailer``
* ``composer require symfony/orm-pack``
* ``composer require --dev symfony/maker-bundle``

************

## Run the server ##
* ``symfony server:start``

