## The theme manager service

This service allows for registering stylesheets and javascripts in a dependency aware fasion to be used in the current template. 

### asset registry

In order to register a stylesheet or javascript in a controller 

```php
// register stylesheet
$this->get('avanzu_admin_theme.theme_manager')
	 ->registerStyle('my-style-id', 'relative/path/to/style.css');

// register javascript
$this->get('avanzu_admin_theme.theme_manager')
	 ->registerScript('my-script-id', 'relative/path/to/script.js');
```

Linking to stylesheets in your templates 

```twig
{# stylesheets #}
{% for style in admin_theme.styles %}
	 <link rel="stylesheet" href="{{ asset(style) }}" />
{% endfor %}
```

Linking to scripts in your templates

```twig
{% for script in admin_theme.scripts %}
	 <script src="{{ asset(script) }}" ></script>
{% endfor %}
``` 


#### Assets with dependencies

Assets can be registered with an array of ids as dependency requirements. 

```php 
$manager = $this->get('avanzu_admin_theme.theme_manager');

// no dependencies
$manager->registerScript('my-script-id', 'relative/path/to/script.js');

// define dependency on script with id "my-script-id"
$manager->registerScript('my-other-id', 'relative/path/to/other.js', array('my-script-id'));
```

The Theme manager will try to resolve the defined dependencies in order to return the asset urls in the right order. 

__Please note: circular dependencies will cause infinite recursion__

#### Javascript groups

Scripts can be assigned to different groups to account for different locations within the template, since some
javascripts need to be loaded in the `<head>` section instead of just before the `</body>`. 

_Group names are not following any convention, feel free to name your groups how you like._

```php
$manager = 	$this->get('avanzu_admin_theme.theme_manager');

// use the "head" group instead of the default one
$manager->registerScript('my-script-id', 'relative/path/to/script.js', array(), 'head');
```

Linking to groups other than the default one inside your templates looks a bit different: 


```twig
{% for script in admin_theme.getScripts('head') %}
	 <script src="{{ asset(script) }}" ></script>
{% endfor %}
``` 
