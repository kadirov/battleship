[![Code Quality](https://img.shields.io/scrutinizer/g/kadirov/battleship.svg)](https://scrutinizer-ci.com/g/kadirov/battleship)
[![Code intelligence](https://scrutinizer-ci.com/g/kadirov/battleship/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/g/kadirov/battleship)

Battleship
------------

This is just sample of code on the symfony framework.

Demo of frontend side: http://bt.kadirov.org

Api documentation of backend side: http://bt.kadirov.org/api/doc

## Configuration

### Database

Copy .env to .env.local and modify database access

~~~
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/battleship
~~~

## Installation


### Install via Composer
~~~
composer install
bin/console doctrine:migration:migrate
~~~

### Run server
~~~
bin/console server:run
~~~

## Done!

Front side: http://localhost:8000

Api Documentation: http://localhost:8000/api/doc

