AdminThemeBundle [![knpbundles.com](http://knpbundles.com/avanzu/AdminThemeBundle/badge-short)](http://knpbundles.com/avanzu/AdminThemeBundle)
================


﻿[![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg)][3]
﻿![Symfony 2.x & 3.x][2]
﻿[![Build Status](https://travis-ci.org/avanzu/AdminThemeBundle.svg?branch=master)](https://travis-ci.org/avanzu/AdminThemeBundle)
﻿[![Latest Stable Version](https://poser.pugx.org/avanzu/admin-theme-bundle/v/stable.png)](https://packagist.org/packages/avanzu/admin-theme-bundle)
﻿[![Latest Unstable Version](https://poser.pugx.org/avanzu/admin-theme-bundle/v/unstable)](https://packagist.org/packages/avanzu/admin-theme-bundle)
﻿[![License](https://poser.pugx.org/avanzu/admin-theme-bundle/license)](https://packagist.org/packages/avanzu/admin-theme-bundle)
 
﻿[![Total Downloads](https://poser.pugx.org/avanzu/admin-theme-bundle/downloads.png)](https://packagist.org/packages/avanzu/admin-theme-bundle)
﻿[![Monthly Downloads](https://poser.pugx.org/avanzu/admin-theme-bundle/d/monthly)](https://packagist.org/packages/avanzu/admin-theme-bundle)
﻿[![Daily Downloads](https://poser.pugx.org/avanzu/admin-theme-bundle/d/daily)](https://packagist.org/packages/avanzu/admin-theme-bundle)

[![Throughput Graph](https://graphs.waffle.io/avanzu/AdminThemeBundle/throughput.svg)](https://waffle.io/avanzu/AdminThemeBundle/metrics/throughput)

Admin Theme based on the AdminLTE Template for easy integration into symfony.
This bundle integrates several commonly used javascripts and the awesome [AdminLTE Template](https://github.com/almasaeed2010/AdminLTE).

## Installation

Installation using composer is really easy: this command will add `"avanzu/admin-theme-bundle": "~1.3"` to your composer.json
and will download the bundle:

```bash
   php composer.phar require avanzu/admin-theme-bundle
```

_Notice: if you prefer to stay with the AdminLTE theme v1.x, manually reference `"avanzu/admin-theme-bundle": "~1.1"` in composer.json `"require"` part and run `php composer.phar update`_

For unstable releases (based in master branch) use:

```bash
   php composer.phar avanzu/admin-theme-bundle dev-master
```

Enable the bundle in your kernel:
```php
<?php
// app/AppKernel.php

public function registerBundles()
{
	$bundles = array(
		// ...
		new Avanzu\AdminThemeBundle\AvanzuAdminThemeBundle(),
	);
}
```

If you use 2.x branch or dev-master version of this bundle you need additionally:

```bash
php bin/console avanzu:admin:initialize
```

Install assets (preferably using symlink method but hardcopy works as well)...

```bash
	php app/console assets:install --symlink
```

Or symfony 3.x/4.x version:

```bash
	php bin/console assets:install --symlink
```

... and fetch vendors:

```
	php app/console avanzu:admin:fetch-vendor
```

Or symfony 3.x/4.x version:

```bash
	php bin/console avanzu:admin:fetch-vendor
```

Additionaly, you can trigger fetch the vendor in each install or update of this bundle, for that edit your archive composer.json and add:

```json
    "scripts": {
        "post-install-cmd": [
            "Avanzu\\AdminThemeBundle\\Composer\\ScriptHandler::fetchThemeVendors"
        ],
        "post-update-cmd": [
            "Avanzu\\AdminThemeBundle\\Composer\\ScriptHandler::fetchThemeVendors"
        ]
    } 
```

### Symfony 2.8 notice
This bundle requires assetic, but it isn't shipped with symfony anymore [since version 2.8](http://symfony.com/doc/current/assetic/asset_management.html). To install assetic, follow these steps:

	php composer.phar require symfony/assetic-bundle

Enable the bundle in your kernel:
```php
<?php
// app/AppKernel.php

public function registerBundles()
{
	$bundles = array(
		// ...
		new Symfony\Bundle\AsseticBundle\AsseticBundle(),
	);
}
```
Add the following lines at `app/config/config_dev.yml`:
```yaml
assetic:
    use_controller: false
```

### Changing default values from templates
If you want to change any default value as for example `admin_skin` all you need to do is define the same at `app/config/config.yml` under `[twig]` section. See example below:

```yaml
# Twig Configuration
twig:
    debug:            "%kernel.debug%"
    strict_variables: "%kernel.debug%"
    globals:
        admin_skin: skin-blue
```

You could also define those values at `app/config/parameters.yml`:

```yaml
admin_skin: skin-blue
```

and then use as follow in `app/config/config.yml`:

```yaml
# Twig Configuration
twig:
    debug:            "%kernel.debug%"
    strict_variables: "%kernel.debug%"
    globals:
        admin_skin: "%admin_skin%"
```

AdminLTE skins are: skin-blue (default for this bundle), skin-blue-light, skin-yellow, skin-yellow-light, skin-green, skin-green-light, skin-purple, skin-purple-light, skin-red, skin-red-light, skin-black and skin-black-light. If you want to know more then go ahead and check docs for AdminLTE [here][1].

There are a few values you could change for sure without need to touch anything at bundle, just take a look under `Resources/views`. That's all.
        
### Upgrade notice
Version >= 1.3 comes with pre packaged asset files located under `Resources/public/static/[prod|dev]`. So, there is no
longer a strict requirement for bower and/or assetic. The assetic groups hovever, are still there and should work as usual.

If the assetic bundle is installed but you don't want the AdminThemeBundle to use it you can add following lines to `config.yml`:
 
```
    avanzu_admin_theme:
        use_assetic: false
```


### Next Steps
* [Using the layout](Resources/docs/layout.md)
* [Rebuilding the assets](Resources/docs/rebuild.md)
* [Using the ThemeManager](Resources/docs/theme_manager.md)
* [Components](Resources/docs/component_events.md)
* [Navbar User](Resources/docs/navbar_user.md)
* [Navbar Tasks](Resources/docs/navbar_tasks.md)
* [Navbar Messages](Resources/docs/navbar_messages.md)
* [Navbar Notifications](Resources/docs/navbar_notifications.md)
* [Sidebar User](Resources/docs/sidebar_user.md)
* [Sidebar Navigation](Resources/docs/sidebar_navigation.md)
* [Breadcrumb Menu](Resources/docs/breadcrumbs.md)
* [Form theme](Resources/docs/form_theme.md)

 [1]: https://almsaeedstudio.com/themes/AdminLTE/documentation/index.html
 [2]: https://img.shields.io/badge/Symfony-%202.x%20&%203.x-green.svg
 [3]: https://github.com/avanzu/AdminThemeBundle/issues?utf8=%E2%9C%93&q=is%3Aopen%20is%3Aissue
