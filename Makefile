help:
	@echo ""
	@echo "usage: make COMMAND"
	@echo ""
	@echo "Commands:"
	@echo "  docker-install     Update PHP dependencies with composer"
	@echo "  composer-dump      Update the autoloader because of new classes in a classmap package"
	@echo "  docker-install     Start nginx proxy container"
	@echo "  docker-start       Create and start containers"
	@echo "  docker-stop        Stop and clear all services"
	@echo "  docker-logs        Follow log output"

docker-install:
	@docker run -d -p 80:80 --name nginx-proxy --restart=always -v /var/run/docker.sock:/tmp/docker.sock:ro jwilder/nginx-proxy

composer-update:
	@docker-compose exec app composer update

composer-dump:
	@docker-compose exec app composer dump-autoload

docker-start:
	@docker-compose up -d

docker-stop:
	@docker-compose down -v

docker-logs:
	@docker-compose logs

artisan-generate:
	@docker-compose exec app php artisan key:generate

passport-install:
	@docker-compose exec app php artisan passport:install

artisan-serve:
	@docker-compose exec app php artisan serve

codeception-build:
	@docker-compose exec app php vendor/bin/codecept build