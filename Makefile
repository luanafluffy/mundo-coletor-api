make up:
	docker-compose up

make php:
	docker-compose exec php /bin/bash

make buil:
	docker-compose up -d --build