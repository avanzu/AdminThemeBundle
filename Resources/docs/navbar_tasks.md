## The Navbar Tasks Component

### Routes
Just like the other theme components, this one requires some route names to work.

* `avanzu_admin_all_tasks` which should point to a list view of tasks.
* `avanzu_admin_show_task` which should point to a particular task.

You could use the following route stubs with your `routing.yml`
```yaml
avanzu_admin_all_tasks:
    path: /tasks/
avanzu_admin_show_task:
    path: /tasks/{taskid}/
```

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
