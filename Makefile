NEW_USER_ID := $(shell id -u)
NEW_GROUP_ID := $(shell id -g)

build:
	docker build -t ddd-symfony-skeleton:latest .

start:
	NEW_USER_ID=$(NEW_USER_ID) NEW_GROUP_ID=$(NEW_GROUP_ID) docker compose up -d

stop:
	NEW_USER_ID=$(NEW_USER_ID) NEW_GROUP_ID=$(NEW_GROUP_ID) docker compose down

bash:
	NEW_USER_ID=$(NEW_USER_ID) NEW_GROUP_ID=$(NEW_GROUP_ID) docker exec -it ddd-symfony-skeleton bash

