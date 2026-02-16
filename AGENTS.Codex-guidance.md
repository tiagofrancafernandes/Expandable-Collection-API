# Codex Guidance and Guardrails

## Priority Rules
1. Read and follow `AGENTS.md` and `TASK.md` first.
2. Keep architecture-first workflow strict.
3. Follow `UNIVERSAL-CODE-STYLE-RULES.md` for all generated code.
4. Prefer maintainability and explicit control flow.

## Execution Checklist
- Confirm current phase from `docs/tasks.md`.
- Implement only the next sequential task.
- Update `docs/progress.md` after each step.
- Record key trade-offs in `docs/decisions.md`.
- Run relevant tests and Laravel Pint checks.

## Current Phase Context
- Phase A foundation is complete.
- Next work begins in Phase B at task 7 (`collection_fields` schema entities).

## Safety
- Do not bypass tenant boundaries.
- Do not introduce permissions without policy and middleware checks.
- Do not merge caching without invalidation rules.
