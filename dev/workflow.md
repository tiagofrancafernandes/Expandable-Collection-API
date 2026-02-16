# Implementation Workflow

## Step Sequence
1. Read `docs/tasks.md` and pick next pending item.
2. Implement smallest viable change for the task.
3. Run quality checks:
   - Pint for formatting/style.
   - Targeted tests.
4. Update:
   - `docs/progress.md`
   - `docs/decisions.md` (if architectural choice made)
5. Commit with clear task-oriented message.

## Quality Checklist
- Guard clauses in place.
- No deep nesting.
- Explicit braces and readable vertical spacing.
- Tenant and permission checks included.
- Tests added/updated for behavior changes.
