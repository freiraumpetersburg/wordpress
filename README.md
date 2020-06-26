# Kulturverein Wordpress

Our Roots based WordPress Multisite Setup

## Development setup

Make sure you have `docker` and `docker-compose` installed. Add `127.0.0.1 kulturverein-petersburg.test` to your `/etc/hosts`. Then run `docker-compose up` to start all services.

To build the theme assets change into the theme directory under `application/content/themes/kulturverein-petersburg` and run `yarn` & `yarn build`. During active development you can run `yarn start`, which starts up a webpack watch task with a browsersync instance and all sorts of other goodies.

Check the `package.json` in the theme directory for all other available commands.

## Managing wordpress core & plugins

Use composer to manage wordpress core and installed plugins. You can find more info [in the bedrock docs](https://roots.io/bedrock/docs/composer/).
