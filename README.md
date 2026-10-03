# Digital Filipino Storybook Platform

A mobile-first Filipino children's reading platform with Laravel 11 API and Flutter client.

## Product vision

This project combines:

- Story discovery and illustrated reading
- Filipino language learning via vocabulary cards
- Audio narration playback
- Quiz and achievement flows
- Parent dashboard with progress analytics
- Admin CMS powered by Filament
- Offline-ready local reading persistence

## Monorepo layout

- `backend/laravel-api` — Laravel REST API + admin CMS
- `mobile/flutter_app` — Flutter Android-first app

## Backend stack

- Laravel 11
- PHP 8.3+
- MySQL 8+
- Sanctum
- Redis for queues (optional)
- Filament admin panel

## Mobile stack

- Flutter
- Provider
- GoRouter
- Dio
- SharedPreferences
- Material 3

## Core user flow

1. Browse stories
2. Open story detail
3. Read pages and listen to narration
4. Study vocabulary
5. Complete storyboard quiz
6. Unlock achievement
7. Track progress in parent dashboard

## Secure by design

- Role-based authorization on the server
- Fine-grained policies and gates
- Validation on all endpoints
- Resource-based responses
- No direct model exposure to mobile clients

## Notes

This repository is structured as a production-quality starter for a portfolio project. The code is intentionally organized around a real-world product workflow rather than a generic CRUD scaffold.
