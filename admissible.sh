#!/usr/bin/env bash
set -euo pipefail

source .env
docker-compose -f docker-compose-prod.yml up -d