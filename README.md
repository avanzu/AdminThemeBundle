AdminThemeBundle
================

Admin Theme based on the AdminLTE Template for easy integration into symfony.
This bundle integrates several commonly used javascripts and the awesome [AdminLTE Template](https://github.com/almasaeed2010/AdminLTE).

## Installation

Installation using composer is really easy: this command will add `"avanzu/admin-theme-bundle": "~2.0"` to your composer.json
and will download the bundle:

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

Install assets (preferably using symlink method but hardcopy works as well)...

	php bin/console assets:install --symlink

Initialize the theme (this will symlink or hardcopy the theme's public files to `web/theme`)

    php bin/console avanzu:admin:initialize [--symlink|--relative]

### Demo-Mode
In order to se a working implementation of the several components, you can enable the demo mode:
 
    # config.yml
    avanzu_admin_theme:
        enable_demo: true

### Configure template settings
Although it is still viable to define the skin using twig globals, there is now a more convenient configuration option.
You can override and/or change several theme settings using specific configuration options rather than spreading 
them all over the place. 

These are the default values:  
 
     # config.yml
      
     avanzu_admin_theme:
        use_twig: true
        enable_demo: false
        theme:
            default_avatar: bundles/avanzuadmintheme/img/avatar.png 
            skin: skin-blue 
            fixed_layout: false 
            boxed_layout: false
            collapsed_sidebar: false
            mini_sidebar: false
            control_sidebar: false
        knp_menu:
            enable: true
            main_menu: avanzu_main
            breadcrumb_menu: false
            

#### AdminLTE skins are:
 - skin-blue (default for this bundle)
 - skin-blue-light 
 - skin-yellow
 - skin-yellow-light
 - skin-green
 - skin-green-light
 - skin-purple
 - skin-purple-light
 - skin-red
 - skin-red-light
 - skin-black
 - skin-black-light 
 
If you want to know more then go ahead and check docs for AdminLTE [here][1].

There are a few values you could change for sure without need to touch anything at bundle, just take a look under `Resources/views`. That's all.


### Upgrade notice

Version >= 2.0 does no longer rely on any external build tools or package managers (except composer of course). 
In consequence, there are no pre packaged scripts/styles or asset groups available. 
If you want to use script and/or stylesheet packing, you will most likely already have the tools of your choice in place 
and are now able to use them as fits best for your needs. 

   
Version >= 1.3 comes with pre packaged asset files located under `Resources/public/static/[prod|dev]`. So, there is no
longer a strict requirement for bower and/or assetic. The assetic groups hovever, are still there and should work as usual.


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
* 

 [1]: https://almsaeedstudio.com/themes/AdminLTE/documentation/index.html
