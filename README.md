# Kulturverein Wordpress

Our Roots based WordPress Multisite Setup

## Development setup

Make sure you have `docker` and `docker-compose` installed. Add `127.0.0.1 kulturverein-petersburg.test` to your `/etc/hosts`. Then run `docker-compose up` to start all services.

To build the theme assets change into the theme directory under `web/app/themes/kulturverein-petersburg` and run `yarn` & `yarn build`. During active development you can run `yarn start`, which starts up a webpack watch task with a browsersync instance and all sorts of other goodies.

Check the `package.json` in the theme directory for all other available commands.

## Managing wordpress core & plugins

Use composer to manage wordpress core and installed plugins. You can find more info [in the bedrock docs](https://roots.io/bedrock/docs/composer/).

## Deployment

- Add a tag and sign it with an administrator's pgp key (currently Alex & Simon), e.g.: `git tag -s -a -m "v0.1.0" v0.1.0`
- Push the tag: `git push --tags`
- Edit the [Petersburg Playbooks](https://git.protonlab.io/petersburg/playbooks) and update the `docker_wordpress_git_tag` variable accordingly.
- Run the playbook: `ansible-playbook goldman.yml -i hosts/production --ask-vault-pass --tags="wordpress"`
