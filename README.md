AdminThemeBundle
================

Admin Theme based on the AdminLTE Template for easy integration into symfony. 
This bundle integrates several commonly used javascripts and the awesome [AdminLTE Template](https://github.com/almasaeed2010/AdminLTE). 

## Installation

Add AdminThemeBundle to composer.json

	{
		"require": {
			"avanzu/admin-theme-bundle": "dev-master"
		}
	} 

tell composer to download the bundle

	php composer.phar update avanzu/admin-theme-bundle
	
Enable the bundle in your kernel:

	<?php 
	// app/AppKernel.php
	
	public function registerBundles()
	{
		$bundles = array(
			// ...
			new Avanzu\AdminThemeBundle\AvanzuAdminThemeBundle(),
		);
	}
	
Fetch vendor scripts 

	app/console avanzu:admin:fetch-vendor
	
install assets (preferably using symlink method but hardcopy works as well)

	app/console assets:install --symlink
	
### Next Steps
* [Using the layout](Resources/docs/layout.md)
* 








	