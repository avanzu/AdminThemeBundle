## The Navbar Notifications Component

### Routes
Just like the other theme components, this one requires some route aliases to work. Please refer to the [component overview][1] to learn about the route alias details. 

### Required aliases
* all_notifications
* notification

### Data Model

In order to use this component, your user class has to implement the `Avanzu\AdminThemeBundle\Model\NotificationInterface`
```php
<?php
namespace MyAdminBundle\Model;
// ...
use Avanzu\AdminThemeBundle\Model\NotificationInterface as ThemeNotification

class NotificationModel implements  ThemeNotification {
	// ...
	// implement interface methods
	// ...
}
```
### Event Listener
Next, you will need to create an EventListener to work with the `NotificationListEvent`.
```php
<?php
namespace MyAdminBundle\EventListener;

// ...

use Avanzu\AdminThemeBundle\Event\NotificationListEvent;
use MyAdminBundle\Model\NotificationModel;

class MyNotificationListListener {

	// ...

	public function onListNotifications(NotificationListEvent $event) {

		foreach($this->getNotifications() as $Notification) {
			$event->addNotification($Notification);
		}

	}

	protected function getNotifications() {
		// retrieve your Notification models/entities here
	}

}
```
### Service.xml

Finally, you need to attach your new listener to the event system:
```xml
<!-- Resources/config/services.xml -->
<parameters>
	<!-- ... -->
	<parameter key="my_admin_bundle.notificationotification_list_listener.class">MyAdminBundle\EventListener\MyNotificationListListener</parameter>
	<!-- ... -->
</parameters>
<services>
	<!-- ... -->
	<service id="my_admin_bundle.notification_list_listener" class="%my_admin_bundle.notification_list_listener.class%">
        <tag name="kernel.event_listener" event="theme.notifications" method="onListNotifications" />
    </service>
	
	<!-- ... -->
</services>
```

[1]: component_events.md