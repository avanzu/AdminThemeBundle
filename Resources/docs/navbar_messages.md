## The Navbar Messages Component

### Routes
Just like the other theme components, this one requires some route aliases to work. Please refer to the [component overview][1] to learn about the route alias details. 

#### required aliases
* all_messages
* message

### Data Model

In order to use this component, your user class has to implement the `Avanzu\AdminThemeBundle\Model\MessageInterface`
```php
<?php
namespace MyAdminBundle\Model;
// ...
use Avanzu\AdminThemeBundle\Model\MessageInterface as ThemeMessage

class MessageModel implements  ThemeMessage {
	// ...
	// implement interface methods
	// ...
}
```

### Event Listener
Next, you will need to create an EventListener to work with the `MessageListEvent`.
```php
<?php
namespace MyAdminBundle\EventListener;

// ...

use Avanzu\AdminThemeBundle\Event\MessageListEvent;
use MyAdminBundle\Model\MessageModel;

class MyMessageListListener {

	// ...

	public function onListMessages(MessageListEvent $event) {

		foreach($this->getMessages() as $message) {
			$event->addMessage($message);
		}

	}

	protected function getMessages() {
		// retrieve your message models/entities here
	}

}
```
### Service.xml

Finally, you need to attach your new listener to the event system:
```xml
<!-- Resources/config/services.xml -->
<parameters>
	<!-- ... -->
	<parameter key="my_admin_bundle.message_list_listener.class">MyAdminBundle\EventListener\MyMessageListListener</parameter>
	<!-- ... -->
</parameters>
<services>
	<!-- ... -->
	<service id="my_admin_bundle.message_list_listener" class="%my_admin_bundle.message_list_listener.class%">
        <tag name="kernel.event_listener" event="theme.messages" method="onListMessages" />
    </service>
	
	<!-- ... -->
</services>
```
[1]: component_events.md