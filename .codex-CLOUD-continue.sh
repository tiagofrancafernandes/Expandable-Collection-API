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


codex cloud exec --env $CODE_CLOUD_ENVIRONMENT "Continue implementation"
