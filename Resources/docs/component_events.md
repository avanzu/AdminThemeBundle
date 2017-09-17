## Accessing components
The contents of the navbar and sidebar are separated into components, following an event driven approach.

The general process to use a particular component is to create an event listener and to use the given event object to add ui elements.

Each component has its own event and specific ui data interfaces.

### Route aliases
Since most of the components do genereate one or two specific links (e.g. task list and task details) the specific routes must be rigged with the option `avanzu_admin_route` which defines the alias name like so: 

```yaml
# routing.yml
avanzu_admin_home:
  path: /demo-admin/
  defaults: {_controller: AvanzuAdminThemeBundle:Default:index}
  options:
    avanzu_admin_route: welcome
```
_"Single item"_ Routes which point to a particular data item all use the parameter `ident` which is defined by the items `getIdentifier()`

#### Available aliases
<dl>
<dt>welcome
<dd>Used for the "homepage" within the theme
<dt>profile
<dd>Used for the current user's profile
<dt>logout
<dd>The logout route
<dt>all_tasks
<dd>Used to generate the task list link
<dt>task 
<dd>Used to generate a link to a specific task. *(single item)*
<dt>all_notifications
<dd>Used to generate the notification list link
<dt>notification
<dd>Used to generate a link to a specific notification. *(single item)*
<dt>all_messages
<dd>generates the message list link 
<dt>message
<dd>Used to generate a link to a specific message. *(single item)*
</dl>


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

 ```yaml
# config.yml
avanzu_admin_theme:
    enable_demo: true
```
and add the routes to your routing configuration: 

```yaml
# routing.yml
avanzu_admin:
    prefix: /admin # or whichever you like 
    resource: "@AvanzuAdminThemeBundle/Resources/config/routes.yml"
```

[Previous (Using the ThemeManager)][1] - [Next (Navbar User)][2]

[1]: https://github.com/avanzu/AdminThemeBundle/blob/master/Resources/docs/theme_manager.md
[2]: https://github.com/avanzu/AdminThemeBundle/blob/master/Resources/docs/navbar_user.md
