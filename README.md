AdminThemeBundle
================

Admin Theme based on the AdminLTE Template for easy integration into symfony.
This bundle integrates several commonly used javascripts and the awesome [AdminLTE Template](https://github.com/almasaeed2010/AdminLTE).

## Installation

Add AdminThemeBundle to composer.json
```json
	{
		"require": {
			"avanzu/admin-theme-bundle": "~1.3"
		}
	}
```
_notice: if you prefer to stay with the adminLTE theme v1.x use `"avanzu/admin-theme-bundle": "~1.1"` instead of `"avanzu/admin-theme-bundle": "~1.3"`_

tell composer to download the bundle

	php composer.phar require avanzu/admin-theme-bundle

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

install assets (preferably using symlink method but hardcopy works as well)

	app/console assets:install --symlink

### Upgrade notice
Version >= 1.3 comes with pre packaged asset files located under `Resources/public/static/[prod|dev]`. So, there is no longer a strict requirement for bower and/or assetic. The assetic groups hovever, are still there and should work as usual.


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
