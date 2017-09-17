## The Navbar User Component

### Routes
Just like the other theme components, this one requires some route aliases to work. Please refer to the [component overview][1] to learn about the route alias details. 

#### Required aliases
* profile
* logout

### Data Model

In order to use this component, your user class has to implement the `Avanzu\AdminThemeBundle\Model\UserInterface`
```php
<?php
namespace MyAdminBundle\Model;
// ...
use Avanzu\AdminThemeBundle\Model\UserInterface as ThemeUser

class UserModel implements  ThemeUser {
	// ...
	// implement interface methods
	// ...
}
```
### Event Listener
Next, you will need to create an EventListener to work with the `ShowUserEvent`.
```php
<?php
namespace MyAdminBundle\EventListener;

// ...

use Avanzu\AdminThemeBundle\Event\ShowUserEvent;
use Avanzu\AdminThemeBundle\Model\NavBarUserLink;
use MyAdminBundle\Model\UserModel;

class MyShowUserListener {

	// ...

	public function onShowUser(ShowUserEvent $event) {

		$user = $this->getUser();
		$event->setUser($user);
		
		$event->setShowProfileLink(false);

		$event->addLink(new NavBarUserLink('Followers', 'logout'));
		$event->addLink(new NavBarUserLink('Sales', 'logout'));
		$event->addLink(new NavBarUserLink('Friends', 'logout', ['id' => 2]));

	}

	protected function getUser() {
		// retrieve your concrete user model or entity
	}

}
```
### Service.xml

Finally, you need to attach your new listener to the event system:
```xml
<!-- Resources/config/services.xml -->
<parameters>
	<!-- ... -->
	<parameter key="my_admin_bundle.show_user_listener.class">MyAdminBundle\EventListener\MyShowUserListener</parameter>
	<!-- ... -->
</parameters>
<services>
	<!-- ... -->
	<service id="my_admin_bundle.show_user_listener" class="%my_admin_bundle.show_user_listener.class%">
        <tag name="kernel.event_listener" event="theme.navbar_user" method="onShowUser" />
    </service>
	
	<!-- ... -->
</services>
```

```yaml
# Resources/config/services.yml
parameters:
    my_admin_bundle.show_user_listener.class: MyAdminBundle\EventListener\MyShowUserListener

services:
    my_admin_bundle.show_user_listener:
        class: %my_admin_bundle.show_user_listener.class%
        tags:
            - { name: kernel.event_listener, event: theme.navbar_user, method: onShowUser }
```

[Previous (Components)][2] - [Next (Navbar Tasks)][3]

[1]: component_events.md
[2]: https://github.com/avanzu/AdminThemeBundle/blob/master/Resources/docs/component_events.md
[3]: https://github.com/avanzu/AdminThemeBundle/blob/master/Resources/docs/navbar_tasks.md
