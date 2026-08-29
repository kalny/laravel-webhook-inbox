analyse:
	docker compose run --rm php vendor/bin/phpstan analyse --memory-limit=512M

format:
	docker compose run --rm php vendor/bin/pint
	
test:
	docker compose run --rm php