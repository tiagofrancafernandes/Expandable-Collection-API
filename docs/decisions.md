# Decisions

## 2026-02-16 - Dynamic Record Storage
- Decision: Use hybrid `jsonb` canonical payload + indexed projection strategy.
- Reason: Preserves flexibility while enabling performant filters/pagination.
- Trade-off: Slightly higher write complexity due to projection maintenance.

## 2026-02-16 - Tenant Boundary
- Decision: Use `project_id` as primary tenant boundary for collections and records.
- Reason: Aligns with product requirement that users own projects and projects own collections.
- Trade-off: Shared cross-project data is not allowed unless explicitly introduced later.

## 2026-02-16 - Authorization Layers
- Decision: Enforce access through global scopes + middleware + policies.
- Reason: Defense-in-depth for both user sessions and API token access.
- Trade-off: Additional implementation complexity and more tests required.

## 2026-02-16 - Delivery Order
- Decision: Execute by phases (foundation -> schema/runtime -> tokens -> media -> perf/docs).
- Reason: Reduces integration risk and keeps incremental testing manageable.
- Trade-off: Some endpoints are delayed until required foundations are complete.

## 2026-02-16 - Foundation Schema Choices
- Decision: Use UUID `public_id` columns on `projects` and `collections` while keeping numeric primary keys internal.
- Reason: Preserves relational performance internally and provides opaque public identifiers for API exposure.
- Trade-off: Slightly wider schema and dual-identifier management.

## 2026-02-16 - Initial Tenant Scope Mechanism
- Decision: Implement global scopes based on authenticated user ownership with a `super-admin` bypass.
- Reason: Establishes a secure default query boundary for non-admin users early in the project lifecycle.
- Trade-off: Requires careful use in console/background contexts where authentication may be absent.
