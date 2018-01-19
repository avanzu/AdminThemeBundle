## Using the layout

Note: this instrucions are for [dev-master branch][4], if you are using stable version (1.3) read this ["Using the layout" for old 1.3 version][5]. 

In order to use the layout, your views should extend from the provided `default-layout`
```twig
{% extends 'AvanzuAdminThemeBundle:layout:default-layout.html.twig' %}
```
### twig global 
Instead of fully relying on blocks and includes, you are provided with a twig global named `avanzu_admin_context` to store and retrieve particular values throughout the page rendering. 
This is basically a parameter bag with some pre-defined values based on the bundle configuration. 

### Partials
In order to make overriding some of the template regions easier, there are several partials included within the layout which can be overridden individually as described [here][1]. 

Listed in the order of appearance, these are:

<dl>
<dt>AvanzuAdminThemeBundle:Partials:_head.html.twig
<dd>Defines the `head` tag contents.
<dt>AvanzuAdminThemeBundle:Sidebar:knp-menu.html.twig
<dd>Renders the knp menu using the builder defined as `main_menu`. 
<br/>___Notice___ *this partial will only be included when the knp_menu is enabled.*
<dt>AvanzuAdminThemeBundle:Breadcrumb:knp-breadcrumb.html.twig
<dd>Rendes the knp menu using the builder defined as `breadcrumb_menu` 
<br/>___Notice___ *this partial will only be included when the knp_menu is enabled.*
<dt>AvanzuAdminThemeBundle:Partials:_footer.html.twig
<dd>Renders the main footer
<dt>AvanzuAdminThemeBundle:Partials:_control-sidebar.html.twig
<dd>Renders the control sidebar (righthand panel) unless it is disabled in the config (default)
<dt>AvanzuAdminThemeBundle:Partials:_scripts.html.twig
<dd>Renders script tags. Located right before the closing `body`. 
</dl>

### layout blocks
The blocks defined in the layout in order of appearance. Some of them do contain some of the major components like the sidebar or navbar. In order to redefine the block and to keep the default content, don't forget to use `{{parent()}}` 

<dt>avanzu_html_start
<dd>In the `html` tag, useful for Angular attributes like ng-app

<dl>
<dt>avanzu_document_title
<dd>Defines the `title` defaults to the contents of `avanzu_page_title`

<dt>avanzu_head
<dd>comes right after the `_head.html.twig` partial

<dt>avanzu_body_start
<dd>In the `body` tag, useful for Angular attributes like ng-app

<dt>avanzu_after_body_start
<dd>comes right after the opening `body` tag

<dt>avanzu_logo_path
<dd>The href value of `a.logo`

<dt>avanzu_logo_mini
<dd>Contents of `.logo-mini`

<dt>avanzu_logo_lg
<dd>Contents of `.logo-lg`

<dt>avanzu_navbar_toggle
<dd>Renders the `.sidebar-toggle` button

<dt>avanzu_navbar_messages
<dd>Renders the `messages` component

<dt>avanzu_navbar_notifications
<dd>Renders the `notifications` component

<dt>avanzu_navbar_tasks
<dd>Renders the `tasks` component

<dt>avanzu_navbar_user
<dd>Renders the `user` component

<dt>avanzu_navbar_control_sidebar_toggle
<dd>Renders the toggle for the `control_sidebar` (if enabled)

<dt>avanzu_sidebar_user
<dd>Renders the `userPanel` component 

<dt>avanzu_sidebar_search
<dd>Renders the `searchPanel` component

<dt>avanzu_sidebar_nav
<dd>Renders the `menu` component _or_ includes `AvanzuAdminThemeBundle:Sidebar:knp-menu.html.twig` depending on wether the `knp_menu` is enabled or not. 

<dt>avanzu_page_title
<dd>Defines the page header inside `.content-header` *(and implicitly the `title` if you haven't changed the content of `avanzu_document_title`)*

<dt>avanzu_page_subtitle
<dd>Defines the `small` portion of `.content-header`

<dt>avanzu_breadcrumb
<dd>Renders either the `breadcrumb` component or includes `AvanzuAdminThemeBundle:Breadcrumb:knp-breadcrumb.html.twig` based on your configuration.

<dt>avanzu_page_content
<dd>The main content area.

<dt>avanzu_page_content_class
<dd>The CSS class for the content block `avanzu_page_content`.

<dt>avanzu_page_content_before
<dd>A block to add additional content right before the start of `avanzu_page_content`.

<dt>avanzu_page_content_after
<dd>A block to add additional content right after the end of `avanzu_page_content`.

<dt>avanzu_footer
<dd>The main footer. Includes `AvanzuAdminThemeBundle:Partials:_footer.html.twig` by default.

<dt>avanzu_control_sidebar
<dd>Includes `AvanzuAdminThemeBundle:Partials:_control-sidebar.html.twig` if it is enabled.

<dt>avanzu_javascripts
<dd>comes right after the `_scripts.html.twig` partial.

<dt>avanzu_javascripts_inline
<dd>Intended for inline scripts in order to keep those in one single document block.
</dl>

[Previous (Readme)][2] - [Next (Rebuilding the assets)][3]

[1]: http://symfony.com/doc/current/templating/overriding.html
[2]: https://github.com/avanzu/AdminThemeBundle/blob/master/README.md
[3]: https://github.com/avanzu/AdminThemeBundle/blob/master/Resources/docs/rebuild.md
[4]: https://github.com/avanzu/AdminThemeBundle/blob/master/Resources/docs/layout.md
[5]: https://github.com/avanzu/AdminThemeBundle/blob/hotfix-1.3.5/Resources/docs/layout.md
