# Kulturverein Wordpress [![Build image](https://github.com/freiraumpetersburg/wordpress/actions/workflows/build.yml/badge.svg)](https://github.com/freiraumpetersburg/wordpress/actions/workflows/build.yml)

Our [Roots](https://roots.io) based WordPress multisite setup

## Development setup

Make sure you have `docker` and `docker-compose` installed. Add `127.0.0.1 kaff-os.test` to your `/etc/hosts`. Then run `docker-compose up` or `docker compose up` (depending on your version) to start all services.

## Managing wordpress core & plugins

Use composer to manage wordpress core and installed plugins. You can find more info [in the bedrock docs](https://roots.io/bedrock/docs/composer/).
