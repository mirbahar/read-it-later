# Mozilla Pocket
Read it later. A project like mozilla pocket.

## Installation

Clone the repository. Make sure you have `docker`, `composer` and `docker-compose` installed in your machine. Now run the following commands -

* Step One
```bash
composer install
```
* Step Two
```bash
cp .env.example .env
```

* Step Three
```bash
./vendor/bin/sail up -d
```

* Step Four
```bash
./vendor/bin/sail artisan key:generate
```
* Step Five : Database Seed Command
```bash
./vendor/bin/sail artisan db:seed
```
* Step Six : Queue run
```bash
./vendor/bin/sail artisan work:queue
```
* Front End : http://localhost:8080/ 
* Phpmyadmin Connection : http://localhost:8082/
* swagger: http://localhost:8080/api/documentation
