docker-local:
	docker compose up --build -d ;\
	docker exec -it app bash -c "composer install"; \
	docker exec -it app bash -c "php artisan migrate"
