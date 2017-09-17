## The Navbar Tasks Component

### Routes
Just like the other theme components, this one requires some route aliases to work. Please refer to the [component overview][1] to learn about the route alias details.
 
#### Required aliases
* all_task
* task

### Data Model

In order to use this component, your user class has to implement the `Avanzu\AdminThemeBundle\Model\TaskInterface`
```php
<?php
namespace MyAdminBundle\Model;
// ...
use Avanzu\AdminThemeBundle\Model\TaskInterface as ThemeTask

class TaskModel implements  ThemeTask {
	// ...
	// implement interface methods
	// ...
}
```
### Event Listener
Next, you will need to create an EventListener to work with the `TaskListEvent`.
```php
<?php
namespace MyAdminBundle\EventListener;

// ...

use Avanzu\AdminThemeBundle\Event\TaskListEvent;
use MyAdminBundle\Model\TaskModel;

class MyTaskListListener {

	// ...

	public function onListTasks(TaskListEvent $event) {

		foreach($this->getTasks() as $task) {
			$event->addTask($task);
		}

	}

	protected function getTasks() {
		// retrieve your task models/entities here
	}

}
```
### Service.xml

Finally, you need to attach your new listener to the event system:
```xml
<!-- Resources/config/services.xml -->
<parameters>
	<!-- ... -->
	<parameter key="my_admin_bundle.task_list_listener.class">MyAdminBundle\EventListener\MyTaskListListener</parameter>
	<!-- ... -->
</parameters>
<services>
	<!-- ... -->
	<service id="my_admin_bundle.task_list_listener" class="%my_admin_bundle.task_list_listener.class%">
        <tag name="kernel.event_listener" event="theme.tasks" method="onListTasks" />
    </service>
	
	<!-- ... -->
</services>
```

[Previous (Navbar User)][2] - [Next (Navbar Messages)][3]

[1]: component_events.md
[2]: https://github.com/avanzu/AdminThemeBundle/blob/master/Resources/docs/navbar_user.md
[3]: https://github.com/avanzu/AdminThemeBundle/blob/master/Resources/docs/navbar_messages.md
