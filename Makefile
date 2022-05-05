ENV = $@

local: db cache
	@docker-compose exec php sh -c "php artisan migrate --env=$(ENV) --no-interaction"

cache: containers
	@docker-compose exec php sh -c "php artisan config:cache --env=$(ENV) --no-interaction"
	@docker-compose exec php sh -c "php artisan route:cache --env=$(ENV) --no-interaction"
	@docker-compose exec php sh -c "php artisan view:cache --env=$(ENV) --no-interaction"

db: containers
	docker-compose exec php sh -c "wait-for-it.sh db:5432"

containers:
	@docker-compose up -d
