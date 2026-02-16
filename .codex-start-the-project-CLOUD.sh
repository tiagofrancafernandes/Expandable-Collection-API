#!/bin/bash

__DIR__=$(dirname "$(readlink -f "$0")")

cd "${__DIR__}"

## codex cloud run "Start the project"

codex cloud run "Start the project"
