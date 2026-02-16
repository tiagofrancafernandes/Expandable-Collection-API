# Architecture Summary

## Multi Tenancy
- Isolation is project-based.
- Tenant context resolved from authenticated user or API token.
- Global scopes applied to tenant-bound models.
- Super admin bypass is explicit and restricted.

## Dynamic Data
- Collection schema stored as metadata.
- Record payload stored in JSONB with indexed ownership fields.
- Internal function values generated through a central resolver.

## Authorization
- Spatie roles for user-level access.
- Token-level permissions per collection and CRUD action.
- Middleware + policy enforcement.

## Performance
- Indexed ownership columns + JSONB GIN indexes.
- Cursor/offset pagination depending endpoint needs.
- Cached idempotent reads with write-triggered invalidation.
