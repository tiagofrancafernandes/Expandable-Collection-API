#!/bin/bash

__DIR__=$(dirname "$(readlink -f "$0")")

cd "${__DIR__}"

## codex run --autopilot --reasoning high --sandbox danger-full-access --network enabled --approval never "Start the project"

codex run --autopilot --reasoning high --sandbox danger-full-access --network enabled --approval never "Start the project"
