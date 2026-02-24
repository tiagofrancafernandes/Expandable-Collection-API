# Decisions

## D-001: Record storage uses JSONB + indexed ownership columns (Hybrid)
- Date: 2026-02-16
- Status: Accepted

### Context
The product requires tenant-defined schema flexibility plus efficient filters and pagination.

### Decision
Use `records.data` as JSONB for dynamic fields and keep strong indexed relational columns (`project_id`, `collection_id`, timestamps, primary id) for fast ownership checks and pagination.

### Consequences
- Supports arbitrary schema evolution without migrations per collection.
- Preserves query performance for common access patterns.
- Enables targeted expression indexes later for hotspot fields.

## D-002: Tenant isolation enforced via global scopes + policy + token middleware
- Date: 2026-02-16
- Status: Accepted

### Context
Single-layer checks are brittle and increase risk of cross-tenant leaks.

### Decision
Enforce access using three layers:
1. model global scopes for tenant-bound data,
2. policies for user management endpoints,
3. token middleware for project/collection API access.

Super-admin bypass is explicit and limited to privileged paths.

### Consequences
- Defense-in-depth against accidental data leaks.
- Slightly higher implementation complexity.

## D-003: Internal functions resolved by registry service at write time
- Date: 2026-02-16
- Status: Accepted

### Context
Dynamic fields may include generated values (`uuid4`, `now`, random variants).

### Decision
Implement an internal function registry and resolve on insert path (and optional update path when configured).

### Consequences
- Centralized extensibility and validation.
- Deterministic behavior and auditable generation logic.

## D-004: Cache strategy uses collection-tag invalidation
- Date: 2026-02-16
- Status: Accepted

### Context
Read endpoints should be cached, but writes must avoid stale responses.

### Decision
Cache read endpoints with keys including project/collection/query hash and invalidate via collection-scoped cache tags on create/update/delete and schema mutations.

### Consequences
- Predictable invalidation behavior.
- Requires cache store with tag support in production.

## D-005: API documentation generator preference
- Date: 2026-02-16
- Status: Accepted

### Context
Need automated docs for large evolving API surface.

### Decision
Prefer `dedoc/scramble` as Laravel-native automated API docs package.

### Consequences
- Faster API documentation upkeep.
- Requires annotation discipline for best output quality.

## D-006: Foundation stack finalized on Laravel 12 + Spatie Permission + Scramble
- Date: 2026-02-16
- Status: Accepted

### Context
Phase 1 requires a stable framework baseline, authorization package baseline, and automated API documentation tooling.

### Decision
Initialize the backend with Laravel 12, add `spatie/laravel-permission` for role/permission primitives, and add `dedoc/scramble` for automated API documentation generation.

### Consequences
- Provides a production-ready baseline aligned with architecture and task plan.
- Reduces later integration risk by installing core dependencies early.
- Enables incremental endpoint documentation as features are implemented.

## D-007: Keep token permission mapping in dedicated `api_token_permissions` table
- Date: 2026-02-20
- Status: Accepted

### Context
Project tokens require per-collection CRUD granularity and should remain queryable and auditable without parsing embedded JSON blobs.

### Decision
Model project tokens in `api_tokens` and store collection-level permission flags in a dedicated `api_token_permissions` table with a unique token+collection constraint.

### Consequences
- Supports explicit and indexable permission checks in middleware/policies.
- Simplifies future permission evolution (`full` and CRUD flags) without changing token identity data.
- Adds one extra join for permission evaluation, offset by relational clarity and safer authorization logic.

## D-008: Request-scoped tenant context resolved through middleware
- Date: 2026-02-20
- Status: Accepted

### Context
Tenant scoping must support both authenticated user flows and upcoming token-based project access while avoiding repeated context derivation logic in each service/policy/scope.

### Decision
Introduce a dedicated `TenantContextResolver` and `TenantContext` value object, and resolve it once per API request via middleware. Accept optional `X-Project-Public-Id` to select project context.

### Consequences
- Centralizes tenant context derivation logic for policies, scopes, and middleware layering.
- Simplifies migration path to token-authenticated project context in Phase 4.
- Enables explicit handling of super-admin and project-selection behavior without duplicating query logic.

