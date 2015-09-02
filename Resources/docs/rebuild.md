## Rebuilding assets
In case you want to rebuild the static scripts or need a build for a custom environment.

### System requirements
In order to rebuild the static asset files, you will need the following node modules (and [node.js](http://nodejs.org/) installed of course):

* [bower](https://www.npmjs.com/package/bower)
* [uglifyjs](https://github.com/mishoo/UglifyJS2)
* [uglifycss](https://github.com/fmarcia/UglifyCSS)


### Install vendor scripts

Configure bower path if neccessary (default value is `/usr/local/bin/bower`)

```yaml
#app/config/config.yml

avanzu_admin_theme:
    bower_bin: /usr/local/bin/bower # that's the default value
```

Fetch vendor scripts

	app/console avanzu:admin:fetch-vendor

The vendor scripts will be stored under `Resources/public/vendor`

Reinstall assets (*only required for previous install with `--hard-copy` option*)

    app/console assets:install


### Build asset files

    app/console avanzu:admin:build-assets

Files will be generated in a subfolder depending on the `--env` command line option.<br/>
*(Please note: the default environment is ___dev___ as usual)*

*example*

    app/console avanzu:admin:build-assets --env=staging

will generate the asset files under `Resources/public/static/staging/`
