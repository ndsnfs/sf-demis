.PHONY: *

include ./docker/.env
export

build:
	export COMPOSE_FILE=docker/build/docker-compose.yml && docker-compose build

up-%:npm-install
	export $$(echo $$(cat docker/deploy/$*/.env | sed 's/#.*//g'| xargs) | envsubst) \
	&& export COMPOSE_FILE=docker/deploy/$*/docker-compose.yml \
	&& docker-compose up -d --no-build --force-recreate --remove-orphans

# в корне проекта
npm-install:
	docker run --rm -it -v ${PWD}/app:/app -w /app  node:latest bash -c "npm install"

# в корне проекта
npm-%:
	docker run --rm -it -v ${PWD}/app:/app -w /app  node:latest bash -c "npm run $*"
