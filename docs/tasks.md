# Tasks


## Phase 1: Foundation
- [x] Initialize Laravel application skeleton.
- [x] Configure PostgreSQL connection and environment examples.
- [x] Install and configure `spatie/laravel-permission`.
- [x] Install and configure API documentation generator.
- [x] Configure Pint and baseline quality scripts.

## Phase 2: Multi-Tenancy Core
- [x] Create core migrations: users, projects, collections, collection_fields, records, media, api_tokens.
- [x] Implement tenant context resolver service.
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

## Phase A - Foundation (Completed)
1.  Scaffold Laravel API project and environment baseline.
2.  Configure PostgreSQL connection and base migrations.
3.  Install and configure `spatie/laravel-permission`.
4.  Implement tenant-aware core models (`User`, `Project`, `Collection`).
5.  Add global scope and super-admin bypass framework.
6.  Create seeders/factories with initial users:
   - `admin@mail.com` / `power@123`
   - `user1@mail.com` / `power@123`
   - `user2@mail.com` / `power@123`

## Phase B - Dynamic Collections
7. Implement schema definition entities (`collection_fields`).
8. Implement schema validation + normalization service.
9. Implement internal function resolver (phase 1 functions).
10. Implement collection records storage with JSONB + projections.
11. Implement collection runtime endpoints (list/show/update/delete).
12. Add schema export endpoints (json/text/d.ts).

## Phase C - Tokens and Permissions
13. Implement project API token model and secure hashing.
14. Implement per-collection CRUD permission mapping.
15. Implement token auth middleware.
16. Implement policy integration for user + token flows.

## Phase D - Media
17. Implement media collection type and constraints.
18. Implement upload/update/delete media endpoints.
19. Add file validation, metadata handling, and visibility flags.

## Phase E - Performance, Quality, Docs
20. Implement endpoint caching and invalidation strategy.
21. Add full automated tests for critical logic and all endpoints.
22. Integrate automated API documentation generation.
23. Finalize root and developer documentation.
24. Run style checks and QA gates.

