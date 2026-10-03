# Laravel API

This directory contains the Laravel REST API for the Digital Filipino Storybook Platform.

## Stack

- Laravel 11+
- PHP 8.3+
- MySQL 8+
- Laravel Sanctum
- Filament admin panel

## Local setup

1. Install PHP 8.3+, Composer, and MySQL.
2. Copy the environment file:
   ```bash
   cp .env.example .env
   ```
3. Generate the app key:
   ```bash
   php artisan key:generate
   ```
4. Run migrations and seed data:
   ```bash
   php artisan migrate --seed
   ```
5. Start the dev server:
   ```bash
   php artisan serve
   ```

## API endpoints

- GET /api/health
- POST /api/register
- POST /api/login
- POST /api/logout
- GET /api/me
- GET /api/stories
- GET /api/stories/{slug}
- POST /api/stories/{story}/progress
- POST /api/stories/{story}/quiz-submit
- GET /api/parent/dashboard

## Admin panel

- Open /admin after login
- Manage stories, pages, authors, categories, vocabulary, quiz data, analytics, and user profiles.
