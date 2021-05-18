# ZORO
Dockerized Laravel-vue Project

ZORO is a papertrading cryptocurrency exchange platform.


***



### Installation : You don't have Docker

#### Requirements
- PHP, Composer, MySQL
#### Installation 
- Clone the project
- Move to **./src** folder
- Install composer dependencies ```composer install```
- Copy and configure your local **.env** file with your database informations ```cp .env.example .env```
- Run migrations & seeders ```php artisan migrate --seed```
- launch server ``` php artisan serve ``` (note: use a different port if you're using xampp to avoid conflicts ``` php artisan serve --port=80 ``` 
- Go to localhost:80


***

### Installation : You have Docker :whale:
#### Requirements
- Docker, Docker Compose
#### Installation 
- Clone the project
- Make sure that your Docker is running
- Move to the root folder **./zoro**
- Run ```docker-compose -up``` (this may take a while the first time)
- Go to localhost:8088
