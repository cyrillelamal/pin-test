ENV = $@

local: db
	@docker-compose exec php sh -c "php artisan migrate --env=$(ENV) --no-interaction"

db: containers
	docker-compose exec php sh -c "wait-for-it.sh db:5432"

containers:
	@docker-compose up -d
