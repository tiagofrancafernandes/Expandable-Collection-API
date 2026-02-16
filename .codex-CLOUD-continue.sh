#!/bin/bash

__DIR__=$(dirname "$(readlink -f "$0")")

cd "${__DIR__}"

if [[ -f "${__DIR__}/.codex.env" ]]; then
    source "${__DIR__}/.codex.env"
fi

echo "CODE_CLOUD_ENVIRONMENT: ${CODE_CLOUD_ENVIRONMENT}"

## codex cloud exec --env $CODE_CLOUD_ENVIRONMENT "Continue implementation"

### Or Specifc
## codex cloud exec --env $CODE_CLOUD_ENVIRONMENT "Implement collection filtering"

DEFUALT_PROMPT='Continue'
PROMPT="${1:-$DEFUALT_PROMPT}"

# codex cloud exec --env $CODE_CLOUD_ENVIRONMENT "Continue implementation"
codex cloud exec --env $CODE_CLOUD_ENVIRONMENT "${PROMPT}"
