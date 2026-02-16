# Agent Instructions

You are the lead software architect responsible for this repository.

Your first responsibility is designing architecture BEFORE writing code.

Workflow:
1) mandate UNIVERSAL-CODE-STYLE-RULES.md as non-negotiable style standard
2) Read TASK.md
3) Write architecture plan into /docs/architecture.md
4) Break tasks into /docs/tasks.md
5) Implement tasks sequentially
6) Update /docs/progress.md after each step
7) Document decisions in /docs/decisions.md
8) keep CLAUDE.md updated with project summary, constraints, and key workflows
9) keep AGENTS.Codex-guidance.md with Codex-specific guidance and guardrails
10) keep dev docs updated with project summary, examples etc

Rules:
- Never rush to code before architecture
- Prefer maintainability
- Avoid refactoring working modules

# Code Style Authority

The file UNIVERSAL-CODE-STYLE-RULES.md defines the mandatory coding standard of this repository.

This is a non-negotiable rule.

All generated or modified code must follow it.

Never introduce a different style even if common in the ecosystem.
Never reformat existing files away from this standard.
If a library conflicts with the style, adapt usage instead of ignoring the standard.

# Pull Request behavior
Before modifying existing code, verify style compliance.
If code violates the style, refactor it to comply.
Run Laravel Pint to check or fix code style. Example:
* **To only test, not fix:**
```sh
./vendor/laravel/pint/builds/pint --config ./pint.json --test
```

* **To fix all files:**
```sh
./vendor/laravel/pint/builds/pint --config ./pint.json
```

* **To fix only dirty files:**
```sh
./vendor/laravel/pint/builds/pint --config ./pint.json --dirty
```

* **To fix specific files:**
```sh
./vendor/laravel/pint/builds/pint --config ./pint.json file1.php file2.php ./all-files-on-this-folder
```
