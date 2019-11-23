## form-theme

This bundle provide a form-theme under [Resources/views/layout/form-theme.html.twig](Resources/views/layout/form-theme.html.twig) which
allow customize the form elements in AdminTLE.

This is used as:

```twig
{% form_theme form '@AvanzuAdminTheme/layout/form-theme.html.twig' %}
```

For override the default theme in twig template you need put in the template which you want the new form theme

```twig
{% form_theme form 'your-custom-form-theme-layout.html.twig' %}
```

For example:

```twig
{% form_theme form 'bootstrap_3_layout.html.twig' %}
```

You also could apply this, only checking if a form is defined:

```twig
{% if form is defined %}
    {% form_theme form '@AvanzuAdminTheme/layout/form-theme.html.twig' %}
{% endif %}
```

Also is possible override the form theme by referencing 
[multiple templates](http://symfony.com/doc/current/cookbook/form/form_customization.html#multiple-templates) in order of priority or
only customize/override some childs elements in the form like:

```twig
{% form_theme form.submit '@AvanzuAdminTheme/layout/form-theme.html.twig' %}
```