# Architecture Plan

## 1) Goals
- Build a multi-tenant, API-only dynamic collections platform on Laravel + PostgreSQL.
- Guarantee strict tenant data isolation with a super-admin bypass.
- Support dynamic collection schemas, references, internal generated values, filters, pagination, and performant reads.
- Provide project tokens with collection-level CRUD permissions.
- Keep the system testable, documented, and maintainable.

## 2) High-Level Domain Model
- `users`
- `projects` (belongs to user)
- `project_members` (optional future expansion)
- `collections` (belongs to project)
- `collection_fields` (schema definition for each collection)
- `collection_records` (dynamic data payload + searchable projections)
- `api_tokens` (belongs to project)
- `api_token_permissions` (token x collection x permission set)
- `media_items` (specialized collection type for files)

## 3) Multi-Tenancy and Authorization Strategy
### Tenant boundary
- Primary tenant boundary is `project_id`.
- Every collection and record operation is scoped by owning project.

### Enforcements
- Global scopes on tenant-bound models for non-super-admin users.
- Policies for per-resource authorization.
- spatie/laravel-permission for roles/permissions.
- Super-admin role bypasses tenant scope and policy restrictions where appropriate.

### Token authorization
- API tokens resolve to project context.
- Middleware validates token and checks operation-level permission on target collection.
- Policies perform final checks for user-authenticated flows.

## 4) Storage Strategy (Performance-First)
### Chosen approach: Hybrid JSONB + indexed projections
- Store canonical record data in `collection_records.data` (`jsonb`).
- Add `collection_records.search_index` (`jsonb`) with normalized, filterable keys.
- Add generated persisted columns for high-frequency fields (`record_id`, `project_id`, `collection_id`, `created_at`, `updated_at`, `published_bool`, etc. as needed).
- Use GIN indexes on jsonb columns and btree indexes on common sort/filter columns.

### Why this strategy
- JSONB offers schema flexibility.
- Projection columns + targeted indexes prevent slow full JSON scans.
- Supports gradual optimization by promoting hot fields to indexed projections without changing client contract.

## 5) Dynamic Schema Engine
### Field definition model
Each field includes:
- `name`
- `type` (scalar, array/json, reference, internal_function)
- `nullable`
- `default`
- `is_indexed`
- `validation_rules`
- `reference_collection_id` (for refs)
- `generator_expression` (for internal_function)

### Validation + normalization pipeline
1. Resolve collection schema.
2. Validate payload shape and field constraints.
3. Resolve generated fields (insert-time).
4. Normalize data into canonical JSON format.
5. Build searchable projection and persist.

### Internal function support (phase 1)
- `now()`
- `uuid4`
- `int_between(min,max)`
- `float_between(min,max)`
- `str_random(length)`

## 6) API Surface (v1)
### Collections Runtime
- `GET /api/v1/collections/{collection}`
- `GET /api/v1/collections/{collection}/schema`
- `GET /api/v1/collections/{collection}/schema/text`
- `GET /api/v1/collections/{collection}/schema/dts`
- `GET /api/v1/collections/{collection}/{record}`
- `PUT /api/v1/collections/{collection}/{record}`
- `DELETE /api/v1/collections/{collection}/{record}`

### Management
- Create/delete collection
- Create media collection
- Upload/update/delete media item
- Create/list/revoke project tokens
- Attach/update per-collection token permissions

## 7) Caching Strategy
- Cache idempotent endpoints (list/show/schema variants).
- Cache keys include project + collection + query hash + pagination.
- Invalidate on create/update/delete for touched collection and record.
- Use cache tags when backend supports tags.

## 8) Testing Strategy
- Feature tests for all required endpoints.
- Unit tests for schema validation, generator resolution, authorization checks, and cache invalidation.
- Policy/middleware tests for token + tenant enforcement.
- Seeders + factories for required baseline users and sample data.

## 9) Documentation Strategy
- Auto API docs via Laravel-compatible package (selected during implementation phase).
- Root `README.md` links to `/dev/README.md`.
- `/dev` contains setup, architecture notes, and usage examples.

## 10) Delivery Phasing
- Phase A: Foundation (Laravel app scaffold, auth, roles, tenancy primitives)
- Phase B: Dynamic schema + collections CRUD runtime
- Phase C: tokens + permission matrix
- Phase D: media subsystem
- Phase E: caching + docs + hardening
