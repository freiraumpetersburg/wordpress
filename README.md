# Kulturverein Wordpress

Our Roots based WordPress Multisite Setup

## Managing wordpress core & plugins

Use composer to manage wordpress core and installed plugins. You can find more info [in the bedrock docs](https://roots.io/bedrock/docs/composer/).

## Deployment

- Add a tag and sign it with an administrator's pgp key (currently Alex & Simon), e.g.: `git tag -s -a -m "v0.1.0" v0.1.0`
- Push the tag: `git push --tags`
- Edit the [Petersburg Playbooks](https://git.protonlab.io/petersburg/playbooks) and update the `docker_wordpress_git_tag` variable accordingly.
- Run the playbook: `ansible-playbook goldman.yml -i hosts/production --ask-vault-pass --tags="wordpress"`
