## The Breadcrumb Component

The breadcrumb maps a list of route to a list of link. The component works
in conjuction with the [Sidebar Navigation](sidebar_navigation.md) component.

### Event Listener

You don't need to build an event listener as long as you've already made it with
the [Sidebar Navigation](sidebar_navigation.md) component. You will 
reuse this listener to build the Breadcrumb list of links.

### Service.xml

Finally, you need to attach your new listener to the event system:

XML: 

```xml
	<!-- Resources/config/services.xml -->
	<parameters>
		<!-- ... -->
		<parameter key="my_admin_bundle.breadcrumb_listener.class">MyAdminBundle\EventListener\MyMenuItemListListener</parameter>
		<!-- ... -->
	</parameters>
	<services>
		<!-- ... -->
		<service id="my_admin_bundle.breadcrumb_listener" class="%my_admin_bundle.breadcrumb_listener.class%">
	        <tag name="kernel.event_listener" event="theme.breadcrumb" method="onSetupMenu" />
	    </service>

		<!-- ... -->
	</services>
```

YAML: 

```yaml
    parameters:
        # ...
        my_admin_bundle.breadcrumb_listener.class: MyAdminBundle\EventListener\MyMenuItemListListener

    services:
        # ...
        my_admin_bundle.breadcrumb_listener:
            class: %my_admin_bundle.breadcrumb_listener.class%
            tags:
                - { name: kernel.event_listener, event:theme.breadcrumb, method:onSetupMenu }
```
As you can see we are using the menu listener from the [Sidebar Navigation](sidebar_navigation.md) 
but attaching to the theme.breadcrumb event.
