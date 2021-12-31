# Hotels

#### Requirements
In order to run this project you will need:

* Docker (https://www.docker.com/community-edition)
* Docker compose (https://docs.docker.com/compose/install/)

#### Local environment

* Nginx
* PHP 7.3 (FPM)
* MySQL

If you use Linux or Mac a *Makefile* is included, so you can run these commands to start and stop all containers at once.
Go to project root and run:

To start docker
```
make up
```

To stop docker
```
make down
```

#### First time instructions:

1) Install Docker and Docker compose
2) If you use Windows copy ``` docker-compose.override.yml.windows ``` to ``` docker-compose.override.yml ```
3) In project root execute ``` make up ```  
4) Then execute ``` make php ``` and then you will be taken into php docker.
5) Execute ``` composer install ```
6) Copy .env.example to .env and replace the fields if necessary.
7) Go inside src folder (please, go inside don't run the command above from outside this folder)
8) Execute ``` php yii migrate ``` to create tables // pwd : /var/www/html/src
9) If they not exist, create ```runtime``` and ```web/assets``` directories inside ```src``` folder.
10) Execute ``` chmod -R 777 runtime && chmod -R 777 web/assets``` 
11) import the dumps found in additional to these databases: thn and thn_test

#### Endpoints
Base url: ``` http://localhost:8097 ```
In the additional folder you will have a collection of postman, please import it

#### Internal / External Ports
* Nginx 80 / 8096
* PostgreSQL 3306 / 3010
* PHP-FPM 9000
(User & pass defined in docker-compose.yml)

### Tests
We have Unit, Integration & Api test. All your work must be tested before send the Pull Request.

Test setup:

* Go to your database and create a new one called ```thn_test```
* Go to the config folder copy ```test_params.example.php``` to ```test_params.php```
* Inside the docker container run from root ```cd src/tests/bin && php yii migrate```


Run test (go inside the docker and run it from root):
```
1.- docker exec -it php-api-container bash OR make php
2.- php vendor/bin/codecept run // for all (unit, integration, api)
```
or
```
composer test-u // for unit tersting
composer test-i // for integration tersting
composer test-a // for api tersting
```

Run:
![Tests](additional/tests-ok.jpg?raw=true)

### Main File
* Config/routes.php

### Main Directories
* Controllers
* Services
* Repositories
* Tests
    * Unit
    * Integration
    * Api
    
### Dump && Collection Postman Directory
* Additional


### Requeriments
The test entails send by param the ID of any hotel that’s in database so the project returns:
1. The basic data of the selected hotel
2. Registered rooms
3. Users who have booked rooms at the hotel

<br>

If you have come this far, thank you very much for your time.
You can ask me questions to my email jairo@group-celit.com