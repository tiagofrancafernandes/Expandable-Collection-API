# Developer Guide

## Purpose
This folder contains implementation-oriented guides for contributors working on the Expandable Collection API.

## Available Guides
- `dev/architecture-summary.md`: condensed architecture reference.
- `dev/workflow.md`: architecture-first workflow and delivery process.

## Foundation Baseline (Phase 1)
- Laravel 12 application skeleton is installed.
- PostgreSQL defaults are configured in `.env.example`.
- `spatie/laravel-permission` is installed with published config and migrations.
- `dedoc/scramble` is installed with published config and views.

## Daily Commands
- Run tests:
  ```bash
  composer test
  ```
- Check style:
  ```bash
  composer lint
  ```
- Fix style for dirty files:
  ```bash
  composer lint:fix
  ```
- Generate/serve API docs:
  ```bash
  php artisan scramble:export
  ```

## Mandatory Rules
- Follow `UNIVERSAL-CODE-STYLE-RULES.md`.
- Follow docs-driven sequence from `AGENTS.md`.
- Update `docs/progress.md` and `docs/decisions.md` when behavior or architecture changes.
