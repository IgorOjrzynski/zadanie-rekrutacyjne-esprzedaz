# Makefile for Docker-based Laravel development

# Ustawienia
APP_CONTAINER := recruitment-app
CLIENT_DIR := petstore-client # Proponowana nazwa katalogu dla wygenerowanego klienta

.PHONY: help build up down stop restart shell install logs generate-client composer-update

help: ## Wyświetla tę pomoc
	@echo "Dostępne komendy:"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

build: ## Zbuduj lub przebuduj obrazy kontenerów
	@docker-compose build

up: ## Uruchom kontenery w tle
	@docker-compose up -d

start: up ## Alias dla 'up'

down: ## Zatrzymaj i usuń kontenery, sieci i wolumeny
	@docker-compose down

stop: ## Zatrzymaj kontenery bez ich usuwania
	@docker-compose stop

restart: stop up ## Zrestartuj kontenery

shell: ## Otwórz powłokę (bash) w kontenerze aplikacji PHP
	@docker-compose exec $(APP_CONTAINER) bash

install: ## Zainstaluj zależności Laravel (Composer i NPM)
	@echo "Instalowanie zależności Composer..."
	@docker-compose exec $(APP_CONTAINER) composer install
	@echo "Instalowanie zależności NPM..."
	@docker-compose exec $(APP_CONTAINER) npm install

logs: ## Wyświetl logi dla wszystkich kontenerów
	@docker-compose logs -f

composer-update: ## Uruchom 'composer update' w kontenerze aplikacji
	@docker-compose exec $(APP_CONTAINER) composer update

generate-client: ## Wygeneruj klienta PHP Guzzle na podstawie api/swagger.json
	@echo "Generowanie klienta API do katalogu '$(CLIENT_DIR)'..."
	@docker run --rm -v "${PWD}:/local" openapitools/openapi-generator-cli generate \
		-i /local/api/swagger.json \
		-g php \
		-o /local/$(CLIENT_DIR) \
		--additional-properties=library=guzzle,invokerPackage=PetstoreClient