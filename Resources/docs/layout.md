## Using the layout

In order to use the layout, your views should extend from the provided base-layout
```twig
	{% extends 'AvanzuAdminThemeBundle:layout:base-layout.html.twig' %}
``
### layout blocks

<dl>
<dt>title</dt>
<dd>located in the title tag</dd>
<dt>stylesheets</dt>
<dd>located in the head. Please don't forget to use {{parent()}} when adding stylesheets in your view(s).</dd>
<dt>javascripts_head</dt>
<dd>Also located in the head. Used to integrate modernizr.js</dd>
<dt>page_title</dt>
<dd>H1 Tag to give the current page a headline.</dd>
<dt>page_subtitle</dt>
<dd>small tag inside the Headline to give extra information.</dd>
<dt>page_content</dt>
<dd>This is the main content area</dd>
<dt>javascripts</dt>
<dd>load your js files in this block.</dd>
<dt>javascripts_inline</dt>
<dd>Instead of spreading inline scripts all over the page, you could use this block to group them.</dd>
</dl>

### predefined asset groups
the bundle integrates several asset groups to be used with assetic:

#### javascripts

use the assetic provided {% javascripts %} tag to integrate one or several asset groups into your view.

*example*
```twig
	{% javascripts
		'@common_js'
		'@admin_lte_js'
	%}
	<script src="{{ asset_url }}"></script>
	{% endjavascripts %}
``
`common_js`

1. jquery
2. jquery-ui
3. undersocre
4. backbone
5. marionette
6. bootstrapjs

`tools_js`

1. momentjs
2. holderjs
3. spinjs

`admin_lte_js`

1. bootstrap-slider
2. jquery.dataTables
3. dataTables.bootstrap
4. jquery.slimscroll
5. adminLTE

`admin_lte_forms_js`

1. bootstrap-colorpicker
2. daterangepicker
3. bootstrap-timepicker
4. jquery.inputmask

`admin_lte_wysiwyg`

1. bootstrap3-wysihtml

`admin_lte_morris`

1. morrisjs

`admin_lte_calendar`

1. fullcalendar

`admin_lte_all`

1. tools_js
2. admin_lte_forms_js
3. admin_lte_wysiwyg
4. admin_lte_morris
5. admin_lte_calendar
6. admin_lte_js


#### Stylesheets
Same as with the javascript asset groups, there are predefined css groups accordingly. Please make sure to use `filter="cssrewrite"`

*example*
```twig
	{% stylesheets
		'@admin_lte_all_css'
		filter="cssrewrite"
	%}
        <link rel="stylesheet" href="{{ asset_url }}" />
    {% endstylesheets %}
```
`admin_lte_css`

1. jquery-ui-1.10.3.custom.css
2. bootstrap.css
3. slider.css
4. dataTables.bootstrap.css
5. font-awesome.css
6. ionicons.css
7. AdminLTE.css

`admin_lte_forms_css`

1. bootstrap-colorpicker.css
2. daterangepicker-bs3.css
3. bootstrap-timepicker.css

`admin_lte_wysiswyg_css`

1. bootstrap3-wysihtml5.css

`admin_lte_morris_css`

1. morris.css

`admin_lte_calendar_css`

1. fullcalendar.css

`admin_lte_all_css`

1. admin_lte_calendar_css
2. admin_lte_morris_css
3. admin_lte_wysiwyg_css
4. admin_lte_forms_css
5. admin_lte_css

