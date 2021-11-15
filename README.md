# Mozilla Pocket
Read it later. A project like mozilla pocket.

## Installation

Clone the repository. Make sure you have `docker`, `composer` and `docker-compose` installed in your machine. Now run the following commands -

##### when completed Clone the repository then following below steps

* Step One
```bash
cd project_directory
composer install
```
*** if you fail your composer install then you will first permission to your project directory and then run ```composer install```

* Step Two
```bash
cp .env.example .env
```
* Step Three: permission storage Folder & .env file(if you need)
```bash
sudo chmod -R 0777 storage/
sudo chmod -R 0777 .env
```
* Step Four: run sail
```bash
./vendor/bin/sail up -d
```
* Step Four
```bash
./vendor/bin/sail artisan key:generate
```
* Step Five: Laravel Migration command
```bash
./vendor/bin/sail artisan migrate
```
* Step Six : Database Seed Command
```bash
./vendor/bin/sail artisan db:seed
```
* Step Seven : Swagger Generate
```bash
./vendor/bin/sail artisan l5-swagger:generate
```
* Step Eight : Queue run command
```bash
./vendor/bin/sail artisan queue:work
```
* Front End : http://localhost:8080/ 
* Phpmyadmin Connection : http://localhost:8082/
```
db_hostName: read_it_later_db
db_username: mirbahar
db_password: admin123
```
* swagger: http://localhost:8080/api/documentation

* Note: if all swagger api dose not work then export postman collection from root project directory.