# Expandable Collection API

Expandable Collection API is a Laravel 12 + PostgreSQL backend for multi-tenant dynamic collections.

## Current Status
- ✅ Phase 1 foundation baseline completed.
- ✅ Laravel application skeleton initialized.
- ✅ PostgreSQL-oriented environment defaults added.
- ✅ `spatie/laravel-permission` and `dedoc/scramble` installed and published.

## Quick Start
1. Install dependencies:
   ```bash
   composer install
   ```
2. Create environment file:
   ```bash
   cp .env.example .env
   ```
3. Generate app key:
   ```bash
   php artisan key:generate
   ```
4. Configure PostgreSQL credentials in `.env`.
5. Run migrations:
   ```bash
   php artisan migrate
   ```
6. Run tests:
   ```bash
   composer test
   ```

## Quality Commands
- Style check:
  ```bash
  composer lint
  ```

- Style autofix for dirty files:
  ```bash
  composer lint:fix
  ```

- Generate/serve API docs:
  ```bash
  php artisan scramble:export
  ```
    or
  ```bash
  composer docs:generate
  ```

## Architecture and Planning Docs
- `docs/architecture.md`
- `docs/tasks.md`
- `docs/progress.md`
- `docs/decisions.md`

## Developer Documentation
See `dev/README.md` for developer guides and workflow details.
