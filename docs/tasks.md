# Tasks

## Phase A - Foundation (Completed)
1. ✅ Scaffold Laravel API project and environment baseline.
2. ✅ Configure PostgreSQL connection and base migrations.
3. ✅ Install and configure `spatie/laravel-permission`.
4. ✅ Implement tenant-aware core models (`User`, `Project`, `Collection`).
5. ✅ Add global scope and super-admin bypass framework.
6. ✅ Create seeders/factories with initial users:
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
