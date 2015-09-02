## The Sidebar User Component

This component uses the same setup as the [Navbar User](navbar_user.md) except for the event name it listens to.

Just add the following tag to your UserShowListener definition in the services.xml and you're good to go:
```xml
<!-- services.xml -->
<!-- ... -->
<service id="my_admin_bundle.show_user_listener" class="%my_admin_bundle.show_user_listener.class%">
<!-- ... -->
    <tag name="kernel.event_listener" event="theme.sidebar_user" method="onShowUser" />
</service>
```