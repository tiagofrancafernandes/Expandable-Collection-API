# Architecture Overview

The system is an API-only multi-tenant platform where:
- A user owns projects.
- A project owns collections.
- A collection stores schema and dynamic records.

## Foundation Implemented
- Laravel 12 application scaffold.
- Permission framework via `spatie/laravel-permission`.
- Tenant-aware global scopes for `Project` and `Collection` models with super-admin bypass.
- Baseline project and collection seed data for tenant testing.

## Planned Runtime Strategy
Records will use a hybrid storage strategy:
- Canonical payload in JSONB.
- Search projection and indexes for efficient filtering and pagination.
