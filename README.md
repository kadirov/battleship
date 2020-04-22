[![Code Quality](https://scrutinizer-ci.com/g/kadirov/battleship/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/kadirov/battleship)
[![Code intelligence](https://scrutinizer-ci.com/g/kadirov/battleship/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/g/kadirov/battleship)

Battleship
------------

This is just sample of code on the symfony framework. Code written on **Mar 10, 2019**

Demo of frontend side: http://bt.kadirov.org

Api documentation of backend side: http://bt.kadirov.org/api/doc


## Installation

### via docker

```bash
docker-compose up -d
```


### Installing dependencies

Enter to php container

```bash
docker-compose exec php bash
```

then install dependencies
```bash
composer install
```

run database migrations

```bash
bin/console doctrine:migration:migrate
```

## Done!

Front side: http://localhost:8502

Api Documentation: http://localhost:8502/api/doc

