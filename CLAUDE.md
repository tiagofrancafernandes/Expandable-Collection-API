# Project Summary
- Multi-tenant dynamic collections API (Laravel + PostgreSQL).
- API-only system with strict data isolation and performance focus.
- Dynamic schemas per collection, including references and generated values.

# Current Constraints
- Architecture-first execution is mandatory before implementation.
- `UNIVERSAL-CODE-STYLE-RULES.md` is non-negotiable.
- Must include automated tests and generated API documentation.
- Must support project tokens with per-collection CRUD permissions.

# Current State
- Phase A foundation is implemented.
- Core models (`User`, `Project`, `Collection`) and global tenant scopes exist.
- `spatie/laravel-permission` is installed with baseline roles and permissions.
- Initial required users are seeded with known credentials.

# Key Workflows
1. Update architecture and task plans before major implementation changes.
2. Implement sequentially by phase from `docs/tasks.md`.
3. Update `docs/progress.md` after each completed step.
4. Document non-trivial decisions in `docs/decisions.md`.
5. Validate style via Laravel Pint before PR.
