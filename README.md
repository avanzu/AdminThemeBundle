AdminThemeBundle
================

Admin Theme based on the AdminLTE Template for easy integration into symfony.
This bundle integrates several commonly used javascripts and the awesome [AdminLTE Template][10].

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

Initialize the theme

    php bin/console avanzu:admin:initialize [--symlink|--relative]

initializing will create several symlinks (falling back to hard copy) into the `web/theme` folder from the required `almasaeed2010/adminlte` package:

 - bootstrap
 - dist
 - plugins
 - documentation
 - starter.html
  

### Configure

Although the bundle should run with zero configruration, there are several settings you might want to adjust to your taste or requirements. 
*Please keep in mind that you don't have to put the whole config block into your configuration but rather the ones you want to change from the defaults.* 

These are the configuration default values:  

```yaml 
# config.yml
      
avanzu_admin_theme:
	use_twig   : true
    enable_demo: false
    theme:
    	default_avatar   : bundles/avanzuadmintheme/img/avatar.png  
        
        skin             : skin-blue  # see skin listing for viable options
        fixed_layout     : false      # -------------------------------------------------------
        boxed_layout     : false      # these settings relate directly to the "Layout Options"
        collapsed_sidebar: false      # described in the adminlte documentation
        mini_sidebar     : false      # -------------------------------------------------------
        control_sidebar  : false      # controls wether the right hand panel will be rendered  
    
	knp_menu:                         # knp menu integration     
    	enable         : true          
        main_menu      : avanzu_main  # the menu builder alias to use for the main menu
        breadcrumb_menu: false        # the menu builder alias to use for the breacrumbs
        
```            

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
 
If you want to know more then go ahead and check docs for AdminLTE [here][9].


### Demo-Mode
In order to se a working implementation of the several components, you can enable the demo mode:

 ```yaml
 # config.yml
 avanzu_admin_theme:
 	enable_demo: true
```
and add the routes to your routing configuration: 

```yaml
# routing.yml
avanzu_admin:
	prefix: /admin
    resource: "@AvanzuAdminThemeBundle/Resources/config/routes.yml"
```

### Upgrade notice

#### Version `>= 2.0`
___This version is not fully backwards compatible regarding the templates and assets.___

- does no longer rely on any external build tools or package managers (except composer of course). 
In consequence, there are no pre packaged scripts/styles or asset groups available. 
If you want to use script and/or stylesheet packing, you will most likely already have the tools of your choice in place and are now able to use them as fits best for your needs. 
- Introduces route name [aliases][2] for url generation inside the components. 
   
#### Version `>= 1.3` 
- comes with pre packaged asset files located under `Resources/public/static/[prod|dev]`. So, there is no
longer a strict requirement for bower and/or assetic. The assetic groups hovever, are still there and should work as usual.


### Next Steps
* [Using the layout][1]
* [Twig widgets][12]
* [Components][2]
* [KnpMenuIntegration][11]
* [Navbar User][3]
* [Navbar Tasks][4]
* [Navbar Messages][5]
* [Navbar Notifications][6]
* [Sidebar User][7]
* [Sidebar Navigation][8]


 [1]: Resources/docs/layout.md
 [2]: Resources/docs/component_events.md
 [3]: Resources/docs/navbar_user.md
 [4]: Resources/docs/navbar_tasks.md
 [5]: Resources/docs/navbar_messages.md
 [6]: Resources/docs/navbar_notifications.md
 [7]: Resources/docs/sidebar_user.md
 [8]: Resources/docs/sidebar_navigation.md
 [9]: https://almsaeedstudio.com/themes/AdminLTE/documentation/index.html
 [10]: https://github.com/almasaeed2010/AdminLTE
 [11]: Resources/docs/knp_menu.md
 [12]: Resources/docs/twig_widgets.md
