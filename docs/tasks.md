# Tasks

## Phase 1: Foundation
- [x] Initialize Laravel application skeleton.
- [x] Configure PostgreSQL connection and environment examples.
- [x] Install and configure `spatie/laravel-permission`.
- [x] Install and configure API documentation generator.
- [x] Configure Pint and baseline quality scripts.

## Phase 2: Multi-Tenancy Core
- [ ] Create core migrations: users, projects, collections, collection_fields, records, media, api_tokens.
- [ ] Implement tenant context resolver service.
- [ ] Implement project-based global scopes.
- [ ] Add super-admin bypass strategy in data access layer.
- [ ] Implement policies for management routes.

## Phase 3: Dynamic Schema Engine
- [ ] Implement collection schema CRUD service.
- [ ] Implement schema validator for create/update records.
- [ ] Implement internal function resolver registry.
- [ ] Implement record persistence service with JSONB sanitization.
- [ ] Implement schema export endpoints (json, text, d.ts).

## Phase 4: Token Authorization
- [ ] Implement API token creation/rotation/revocation.
- [ ] Implement token middleware authentication.
- [ ] Implement per-collection CRUD permission evaluator.
- [ ] Enforce middleware + policy combined checks.

## Phase 5: Records API + Performance
- [ ] Implement collection record list/show/create/update/delete endpoints.
- [ ] Add pagination, safe filtering, and sorting.
- [ ] Add database indexes for access patterns.
- [ ] Implement cache read-through on idempotent endpoints.
- [ ] Implement cache invalidation on create/update/delete + schema change.

## Phase 6: Media Management
- [ ] Implement media collection setup.
- [ ] Implement media upload endpoint and metadata persistence.
- [ ] Implement media update/delete endpoints.

## Phase 7: Testing + Seed Data + Docs
- [ ] Build factories and seeders including required initial users.
- [ ] Add unit tests for schema, function resolver, permission evaluator.
- [ ] Add feature tests for isolation and endpoint coverage.
- [ ] Write root README with setup and architecture summary.
- [ ] Write `/dev/README.md` and developer guides.
- [ ] Ensure generated API docs are published and accessible.

## Current Iteration Focus
- [x] Create architecture and phased task plan.
- [x] Document progress baseline.
- [x] Document architectural decisions and rationale.
- [x] Update agent-oriented project guidance docs.
