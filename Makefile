.PHONY: up down

MAKEPATH := $(abspath $(lastword $(MAKEFILE_LIST)))
PWD := $(dir $(MAKEPATH))

up:
	docker-compose up -d --build

down:
	docker-compose down

ps:
	docker-compose ps

build:
	docker-compose build

nginx: 
	docker exec -it nginx-api-container bash

php: 
	docker exec -it php-api-container bash

postgre:
	docker exec -it postgre-api-container bash