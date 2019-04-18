#!/bin/sh

yarn upgrade --latest
yarn bower update
composer update --no-dev
yarn grunt
