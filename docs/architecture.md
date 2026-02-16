# Architecture Plan

## 1. Objective
Build a multi-tenant dynamic database API (Laravel + PostgreSQL) where each tenant can define collections with custom schema while preserving strict data isolation, performance, and auditable access controls.

## 2. Architecture Principles
- Enforce tenant boundaries in every data access path.
- Prefer explicit, policy-driven authorization.
- Keep dynamic data flexible while preserving indexable query paths.
- Use deterministic generation for internal function fields.
- Design for cacheable read APIs with reliable invalidation.

## 3. System Context
- Runtime: Laravel API application.
- Primary DB: PostgreSQL.
- Authorization: `spatie/laravel-permission` + project token permission matrix.
- API docs: automated generation package (Scramble preferred).
- Auth modes:
  - Session/user auth for management APIs.
  - Token auth for project collection data APIs.

## 4. Domain Model
### 4.1 Core Entities
- `users`
- `projects` (belongs to user)
- `project_members` (future-ready collaboration)
- `api_tokens` (belongs to project, hashed secret)
- `collections` (belongs to project)
- `collection_fields` (schema definition per collection)
- `records` (dynamic payload per collection)
- `media` (project-scoped media records)

### 4.2 Ownership Chain
`user -> project -> collection -> record`

Every row in tenant data tables carries `project_id` to keep isolation enforceable and index-friendly.

## 5. Multi-Tenancy & Isolation Strategy
### 5.1 Tenant Context Resolver
A dedicated service resolves current tenant context from:
1. Authenticated user context (management API), or
2. API token context (public/project API).

### 5.2 Global Scopes
Apply `project_id` global scopes on tenant-bound models:
- Collection
- CollectionField
- Record
- Media
- ApiToken

### 5.3 Super Admin Bypass
Super admin role bypasses tenant global scope through explicit scope disabling in repository/service layer, never implicitly.

### 5.4 Policies + Middleware
- Middleware validates token/project binding and requested collection permission.
- Policies enforce user-level access for management endpoints.
- Both middleware and policies must pass for sensitive operations.

## 6. Dynamic Schema Design
### 6.1 Schema Metadata
`collection_fields` stores:
- `key`
- `type` (`int`, `float`, `boolean`, `string`, `null`, `json`, `reference`, `internal_function`)
- `is_required`
- `is_nullable`
- `default_value`
- `reference_collection_id` (nullable)
- `internal_function_name` (nullable)
- `options` (JSON for extensibility)

### 6.2 Record Storage Strategy (Chosen)
Use hybrid strategy:
- Primary dynamic payload in `records.data` (`jsonb`).
- Frequently queried helper columns in `records`:
  - `id` (uuid)
  - `project_id`
  - `collection_id`
  - `created_at`, `updated_at`
  - `search_text` (optional denormalized text summary)

Rationale:
- `jsonb` keeps schema flexibility.
- B-tree indexes on ownership columns + timestamps guarantee fast pagination.
- GIN index on `data` enables selective filtered lookup.
- Optional generated/materialized columns can be added per hotspot collection later without breaking API contract.

### 6.3 Validation Pipeline
On create/update:
1. Load collection schema snapshot.
2. Validate required/nullable/type constraints.
3. Resolve internal function fields for create operations.
4. Validate references belong to same project.
5. Persist sanitized payload.

## 7. Internal Function Engine
A dedicated resolver registry:
- `now()` -> current ISO datetime.
- `uuid4` -> UUID v4.
- `random_int`, `random_float`, `random_string` -> deterministic parameterized generators.
- `range` -> configured numeric range.

Execution rules:
- Only allowed when field type is `internal_function`.
- Evaluate at insert (and optionally update if configured).
- Reject unknown functions early with validation errors.

## 8. API Surface
### 8.1 Collection Data APIs
- List records (with filters + pagination).
- Show record.
- Create/update/delete record.
- Schema export:
  - JSON
  - plain text
  - TypeScript `d.ts`

### 8.2 Management APIs
- Create/delete collection.
- Manage media collection.
- Upload/update/delete media.
- Manage project tokens and per-collection CRUD permissions.

## 9. Permission Model
### 9.1 User Role Permissions
Spatie roles:
- `super-admin`
- `project-owner`
- `project-member` (future)

### 9.2 Token Permission Matrix
`api_tokens.permissions` JSON structure:
```json
{
  "collection_uuid": {
    "create": true,
    "read": true,
    "update": false,
    "delete": false,
    "full": false
  }
}
```

Permission evaluation:
- `full=true` implies all CRUD.
- Missing collection entry denies access.

## 10. Caching Strategy
### 10.1 Cacheable Endpoints
- List records
- Show record
- Schema exports

### 10.2 Cache Key
Key dimensions:
- project_id
- collection_id
- endpoint type
- query hash
- pagination parameters

### 10.3 Invalidation
On record create/update/delete:
- Flush tagged cache for `project:{id}:collection:{id}`.

On schema changes:
- Flush collection schema and list caches.

## 11. Performance Plan
- DB indexes:
  - `(project_id, collection_id, created_at desc)`
  - GIN index on `data jsonb_path_ops`
  - selective expression indexes for heavily queried keys.
- Cursor pagination for large datasets.
- Strict field whitelist for filtering/sorting.
- N+1 prevention via explicit eager loading where relationships are used.

## 12. Testing Plan (Architecture-Level)
- Unit tests:
  - schema validator
  - internal function resolver
  - token permission evaluator
- Feature tests:
  - tenant isolation
  - CRUD and schema endpoints
  - token authorization matrix
  - cache invalidation semantics
- Seeders/factories:
  - required initial users
  - projects/collections sample fixtures

## 13. Implementation Phases
1. Foundation setup (Laravel app, packages, base config).
2. Multi-tenancy primitives (context, scopes, policies).
3. Dynamic schema + record engine.
4. Token permissions middleware and enforcement.
5. Caching and invalidation.
6. Automated API docs and developer docs.
7. Comprehensive tests and seeders.

## 14. Risks and Mitigations
- Risk: JSONB filter performance degradation.
  - Mitigation: bounded filter grammar + targeted expression indexes.
- Risk: Cross-tenant reference leakage.
  - Mitigation: project-bound reference validator.
- Risk: cache staleness.
  - Mitigation: tag-based invalidation at write boundaries.
