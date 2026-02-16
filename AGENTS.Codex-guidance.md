# Codex Guidance and Guardrails

## Purpose
Operational guardrails for Codex while implementing this repository.

## Mandatory Order
1. Confirm style and architecture constraints.
2. Read and align with `docs/architecture.md` and `docs/tasks.md`.
3. Implement only the next planned task unless reprioritization is documented.
4. Update `docs/progress.md` and `docs/decisions.md` when relevant.

## Implementation Guardrails
- Use explicit control flow with guard clauses.
- Avoid deep nesting.
- Keep functions focused and composable.
- Do not introduce cross-tenant queries without explicit project constraints.
- Validate schema and permissions before data writes.

## Security Guardrails
- Never expose raw token secrets after creation.
- Always enforce token permission checks at middleware boundary.
- Ensure reference fields cannot point across projects.

## Quality Guardrails
- Run formatter/linter (`pint`) for changed PHP files.
- Run targeted tests for changed modules.
- Keep docs updated with behavior changes.

## Documentation Guardrails
- Any architectural deviation requires an entry in `docs/decisions.md`.
- Any task reorder requires update in `docs/tasks.md` and `docs/progress.md`.
