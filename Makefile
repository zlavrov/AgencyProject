include .env.local

composer:
	composer install

jwt:
	php bin/console lexik:jwt:generate-keypair --skip-if-exists

start:
	php -S 192.168.0.139:8080 -t public

drop:
	php bin/console doctrine:database:drop --force

create:
	php bin/console doctrine:database:create

migration:
	php bin/console make:migration

migrate:
	php bin/console doctrine:migrations:migrate -n

fixtere:
	php bin/console doctrine:fixtures:load -q

cache:
	php bin/console cache:clear
