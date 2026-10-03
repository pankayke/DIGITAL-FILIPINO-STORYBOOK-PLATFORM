setup:
	@echo "Setting up the Digital Filipino Storybook Platform"
	@echo "1. Install PHP 8.3+, Composer, MySQL, and Flutter SDK"
	@echo "2. In backend/laravel-api: composer install && cp .env.example .env && php artisan key:generate && php artisan migrate --seed"
	@echo "3. In mobile/flutter_app: flutter pub get && flutter run"

backend-setup:
	cd backend/laravel-api && composer install && cp .env.example .env && php artisan key:generate && php artisan migrate --seed

mobile-setup:
	cd mobile/flutter_app && flutter pub get

mobile-run:
	cd mobile/flutter_app && flutter run

api-test:
	cd backend/laravel-api && php artisan test

help:
	@sed -n '1,120p' Makefile
