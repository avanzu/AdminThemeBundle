## Using the layout

In order to use the layout, your views should extend from the provided base-layout
```twig
{% extends 'AvanzuAdminThemeBundle:layout:base-layout.html.twig' %}
```
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


### packaged assets
the bundle comes with a set of pre packaged assets located under `Resources/public/static/[dev|prod]`. These are basically the assetic groups (see below) uglified and ready to use with the regular `{{ asset() }}` helper in combination with the application's environment.

*example*
```twig
<link rel="stylesheet" href="{{ asset('bundles/avanzuadmintheme/static/'~ app.environment ~'/styles/admin-lte-all.css') }}" />
```
___File names___

The packaged file names reflect the asset group name as follows:
* underscores are replaced with dashes
* `_js` and `_css` suffixes are removed
* javascripts will be placed under `scripts`
* stylesheets will be placed under `styles`

*example*

`@admin_lte_js` will be uglified into `scripts/admin-lte.js`

`@admin_lte_all_css` will be uglified into `styles/admin-lte-all.css`

In order to find the file you need, please refer to the following group setup.

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
```
`common_js (scripts/common.js)`

1. jquery
2. jquery-ui
3. undersocre
4. backbone
5. marionette
6. bootstrapjs

`tools_js (scripts/tools.js)`

1. momentjs
2. holderjs
3. spinjs

`admin_lte_js (scripts/admin-lte.js)`

1. bootstrap-slider
2. jquery.dataTables
3. dataTables.bootstrap
4. jquery.slimscroll
5. adminLTE

`admin_lte_forms_js (scripts/admin-lte-forms.js)`

1. bootstrap-colorpicker
2. daterangepicker
3. bootstrap-timepicker
4. jquery.inputmask

`admin_lte_wysiwyg (scripts/admin-lte-wysiwyg.js)`

1. bootstrap3-wysihtml

`admin_lte_morris (scripts/admin-lte-morris.js)`

1. morrisjs

`admin_lte_calendar (scripts/admin-lte-calendar.js)`

1. fullcalendar

`admin_lte_all (scripts/admin-lte-all.js)`

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

`admin_lte_css (styles/admin-lte.css)`

1. jquery-ui-1.10.3.custom.css
2. bootstrap.css
3. slider.css
4. dataTables.bootstrap.css
5. font-awesome.css
6. ionicons.css
7. AdminLTE.css

`admin_lte_forms_css (styles/admin-lte-forms.css)`

1. bootstrap-colorpicker.css
2. daterangepicker-bs3.css
3. bootstrap-timepicker.css

`admin_lte_wysiswyg_css (styles/admin-lte-wysiwyg.css)`

1. bootstrap3-wysihtml5.css

`admin_lte_morris_css (styles/admin-lte-morris.css)`

1. morris.css

`admin_lte_calendar_css (styles/admin-lte-calendar.css)`

1. fullcalendar.css

`admin_lte_all_css (styles/admin-lte-all.css)`

1. admin_lte_calendar_css
2. admin_lte_morris_css
3. admin_lte_wysiwyg_css
4. admin_lte_forms_css
5. admin_lte_css
