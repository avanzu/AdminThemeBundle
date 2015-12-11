## The Navbar User Component

### Routes
Just like the other theme components, this one requires some route names to work.

* `avanzu_admin_profile` which should point to the current user's profile page.
* `avanzu_admin_logout` which should point to the logout mechanism.

You could use the following route stubs with your `routing.yml`
```yaml
avanzu_admin_profile:
    path: /profile/{userid}/
avanzu_admin_logout:
    path: /logout
```

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
use MyAdminBundle\Model\UserModel;

class MyShowUserListener {

	// ...

	public function onShowUser(ShowUserEvent $event) {

		$user = $this->getUser();
		$event->setUser($user);

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
