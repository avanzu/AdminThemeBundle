AdminThemeBundle
================

Admin Theme based on the AdminLTE Template for easy integration into symfony.
This bundle integrates several commonly used javascripts and the awesome [AdminLTE Template](https://github.com/almasaeed2010/AdminLTE).

## Installation

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

Add AdminThemeBundle to composer.json
```json
	{
		"require": {
			"avanzu/admin-theme-bundle": "1.1.4"
		},
	    "scripts": {
	        "post-install-cmd": [
	            "Avanzu\\AdminThemeBundle\\Composer\\ScriptHandler::install"
	        ],
	        "post-update-cmd": [
	            "Avanzu\\AdminThemeBundle\\Composer\\ScriptHandler::install"
	        ]
	    },
	}
```

Configure bower path if neccessary (default value is `/usr/local/bin/bower`)

```yaml

	#app/config/config.yml

	avanzu_admin_theme:
    	bower_bin: /usr/local/bin/bower # that's the default value
```

Finally tell composer to download the bundle

	php composer.phar update avanzu/admin-theme-bundle

install assets (preferably using symlink method but hardcopy works as well)

	app/console assets:install --symlink

If you need to invoke bower to refetch vendor scripts (ran automatically by composer):

	app/console avanzu:admin:fetch-vendor -u

### Next Steps
* [Using the layout](Resources/docs/layout.md)
* [Using the ThemeManager](Resources/docs/theme_manager.md)
* [Components](Resources/docs/component_events.md)
* [Navbar User](Resources/docs/navbar_user.md)
* [Navbar Tasks](Resources/docs/navbar_tasks.md)
* [Navbar Messages](Resources/docs/navbar_messages.md)
* [Navbar Notifications](Resources/docs/navbar_notifications.md)
* [Sidebar User](Resources/docs/sidebar_user.md)
* [Sidebar Navigation](Resources/docs/sidebar_navigation.md)









