# Project Summary
Expandable Collection API is a Laravel + PostgreSQL backend for multi-tenant dynamic collections.

Core goals:
- strict tenant isolation,
- dynamic user-defined collection schema,
- per-project/per-collection token permissions,
- performant read APIs with safe cache invalidation,
- complete automated tests and API docs.

# Constraints
- Architecture-first workflow is mandatory.
- `UNIVERSAL-CODE-STYLE-RULES.md` is non-negotiable style authority.
- Never bypass tenant safety checks.
- Prefer maintainability over rapid, risky refactors.

# Key Workflows
1. Read `TASK.md` and current docs.
2. Update architecture and task plan before significant implementation.
3. Implement in small sequential phases.
4. Update `docs/progress.md` after each completed step.
5. Record non-trivial decisions in `docs/decisions.md`.
6. Keep developer docs and guidance in sync with actual architecture.

# Current Delivery Stage
Phase 2 has started.
Completed: core multi-tenant migrations baseline (`collection_fields`, `records`, `media`, `api_tokens`, `api_token_permissions`).
Completed: tenant context resolver service and API middleware binding.
Next stage: implement project-based global scope expansion and super-admin bypass hardening in the data access layer.
