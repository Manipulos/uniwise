build:
	cp -f ./nginx/Dockerfile .
	docker build -t test-nginx .
	rm -f Dockerfile
	cp -f ./php-fpm/Dockerfile .
	docker build -t test-php .
	rm -f Dockerfile
composer-install:
	docker-compose run php bash -c "cd /app/ext; composer install"

import-cars:
	docker-compose exec -T db bash -c "mysql --user=\$${MYSQL_USER} --password=\$${MYSQL_PASSWORD} wiseflow" < ../resources/db/cars.sql

import-equipment:
	docker-compose exec -T db bash -c "mysql --user=\$${MYSQL_USER} --password=\$${MYSQL_PASSWORD} wiseflow" < ../resources/db/equipment.sql

doctrine-migrate:
	until docker-compose run php bash -c "cd /app/Uniwise/Symfony; ./console doctrine:schema:update --force"; do sleep 1; done

run-php: composer-install
	docker-compose up -d

run: run-php doctrine-migrate import-cars

stop:
	docker-compose down

