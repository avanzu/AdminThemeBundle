# KnpMenu integration
The KnpMenu can be used instead of the regular builtin menu and breadcrumb components. 

## Install the suggested dependency ##

Install through composer with:

```
composer require knplabs/knp-menu-bundle
```

And add in your AppKernel `new Knp\Bundle\MenuBundle\KnpMenuBundle(),`

## Enabling the KnpMenu support 
In order to use the KnpMenu integration you need to enable it in the configuration: 

```yaml
# config.yml
avanzu_admin_theme:
    knp_menu:   
    	enable : true
```
Enabling the KnpMenu support will render the regular breadcrumb and menu events inactive. 
Instead there will be a new `knp_menu.menu_builder` aliased `avanzu_main` which will dispatch a new event to hook into.

### Attaching an event listener

Quite similar to the `ThemeEvents::THEME_SIDEBAR_SETUP_MENU`, using the knp_menu will trigger the `ThemeEvents::THEME_SIDEBAR_SETUP_KNP_MENU` event. 


#### example code 

```yaml
# services.yml

services:

    # ...
    
    app.setup_knp_menu_listener:
        class: AppBundle\SetupKnpMenuListener
        tags:
            - { name: kernel.event_listener, event: theme.sidebar_setup_knp_menu, method: onSetupMenu }

```

The event listener will receive the `KnpMenuEvent` gives access to the root menu item, the menu factory and, if applicable the `$options` and `$childOptions` as configured in the menu builder. 

```php
use Avanzu\AdminThemeBundle\Event\KnpMenuEvent;

class SetupKnpMenuListener
{
    public function onSetupMenu(KnpMenuEvent $event)
    {
        $menu = $event->getMenu();
        
        // Adds a menu item which acts as a label
        $menu->addChild('MainNavigationMenuItem', [
       	    'label' => 'MAIN NAVIGATION',
            'childOptions' => $event->getChildOptions()
        ]
        )->setAttribute('class', 'header');
        
        // A "regular" menu item with a link
        $menu->addChild('TestMenuItem', [
            'route' => 'homepage',
            'label' => 'Homepage',
            'childOptions' => $event->getChildOptions()
        ]
        )->setLabelAttribute('icon', 'fa fa-flag');
        
        // Adds a menu item which has children
        $menu->addChild('DataMenuItem', [
            'label' => 'Database mangement',
            'childOptions' => $event->getChildOptions()
        ]
        )->setLabelAttribute('icon', 'fa fa-database');
        // First child, a regular menu item
        $menu->getChild('DataMenuItem')->addChild('DataUsersMenuItem', [
            'route' => 'app.database.users',
            'label' => 'Users table',
            'childOptions' => $event->getChildOptions()
        ]
        )->setLabelAttribute('icon', 'fa fa-user');
        // Second child, a regular menu item
        $menu->getChild('DataMenuItem')->addChild('DataGroupsMenuItem', [
            'route' => 'app.database.groups',
            'label' => 'Groups table',
            'childOptions' => $event->getChildOptions()
        ]
        )->setLabelAttribute('icon', 'fa fa-users');
    }
}
```
For a more in depth guide on how to use the KnpMenuBundle, please refer to the [official documentation][1]. 

### Replacing the MenuBuilder

Rather than using the menu builder provided by this bundle (which is aliased as `avanzu_main`), you could also generate your own implementation and change the bundle configuration to use your menu builder alias. 

```yaml
# config.yml

avanzu_admin_theme:
    # ... 
    knp_menu:   
        enable : true
        main_menu: <your builder alias> # By default "avanzu_main" alias
        breadcrumb_menu: <your builder alias or false to disable breadcrumbs>

```

## Using the avanzu_admin_context kpn menu ##

If your layout or default layout is using avanzu_admin_context.knp_menu.enable for check if the knp menu is enabled, you need use
the options context instead the general config. That is use the options key as following:

```yaml
# config.yml

avanzu_admin_theme:
    # ... 
    options:
        knp_menu:   
            enable : true
            main_menu: <your builder alias> # By default "avanzu_main" alias
            breadcrumb_menu: <your builder alias or false to disable breadcrumbs>

```

[Previous (Sidebar Navigation)][2] - [Next (Breadcrumb Menu)][3]

[1]: http://symfony.com/doc/current/bundles/KnpMenuBundle/index.html
[2]: https://github.com/avanzu/AdminThemeBundle/blob/master/Resources/docs/sidebar_navigation.md
[3]: https://github.com/avanzu/AdminThemeBundle/blob/master/Resources/docs/breadcrumbs.md
