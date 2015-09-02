## Accessing components
The contents of the navbar and sidebar are separated into components, following an event driven approach.

The general process to use a particular component is to create an event listener and to use the given event object to add ui elements.

Each component has its own event and specific ui data interfaces.

### Available components

* [Navbar User](navbar_user.md)
* [Navbar Tasks](navbar_tasks.md)
* [Navbar Notifications](navbar_notifications.md)
* [Navbar Messages](navbar_messages.md)
* [Sidebar User](sidebar_user.md)
* [Sidebar Search](sidebar_search.md)
* [Sidebar Navigation](sidebar_navigation.md)
* [Breadcrumb Menu](breadcrumbs.md)

### Demonstration

In order to see some working examples, the bundle comes with a demo implementation for each component.

Simply remove the comments in the `services.xml` that comes with this bundle, and import the routing to your `routing.yml`
```yaml
avanzu_admin:
    resource: "@AvanzuAdminThemeBundle/Resources/config/routes.yml"

```
