#!/bin/bash

__DIR__=$(dirname "$(readlink -f "$0")")

cd "${__DIR__}"

## codex cloud exec "Start the project"

codex cloud exec "Start the project"
