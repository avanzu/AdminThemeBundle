## The Navbar Messages Component

### Routes
Just like the other theme components, this one requires some route names to work.

* `avanzu_admin_all_messages` which should point to a list view of messages.
* `avanzu_admin_show_message` which should point to a particular message.

You could use the following route stubs with your `routing.yml`
```yaml
avanzu_admin_all_messages:
    path: /messages/
avanzu_admin_show_message:
    path: /messages/{messageid}/
```

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
