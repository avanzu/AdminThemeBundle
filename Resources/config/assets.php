<?php
/**
 * assets.php
 * avanzu-admin
 * Date: 21.03.15
 */

return call_user_func(
    function () {
        $jsAssets = '@AvanzuAdminThemeBundle/Resources/';
        $lteJSBase = $jsAssets . 'bower/bower_components/adminlte/';
        $cssAssets = 'bundles/avanzuadmintheme/';
        $lteCssBase = $cssAssets . 'vendor/adminlte/';

        return [
            'modernizr_js' => [
                'inputs' => [
                    $jsAssets . 'bower/bower_components/modernizr/modernizr.js',
                ],
            ],
            'common_js' => [
                'inputs' => [
                    $jsAssets . 'bower/bower_components/jquery/dist/jquery.js',
                    $jsAssets . 'bower/bower_components/jquery-ui/jquery-ui.js',
                    $jsAssets . 'bower/bower_components/underscore/underscore.js',
                    $jsAssets . 'bower/bower_components/bootstrap/dist/js/bootstrap.min.js',
                    $jsAssets . 'bower/bower_components/bootbox/bootbox.js',
                ],
            ],
            'tools_js' => [
                'inputs' => [
                    '@common_js',
                    $jsAssets . 'bower/bower_components/momentjs/moment.js',
                    $jsAssets . 'bower/bower_components/holderjs/holder.js',
                    $jsAssets . 'bower/bower_components/spinjs/spin.js',
                ],
            ],
            'admin_lte_js' => [
                'inputs' => [
                    $lteJSBase . 'plugins/bootstrap-slider/bootstrap-slider.js',
                    $lteJSBase . 'plugins/datatables/jquery.dataTables.js',
                    $lteJSBase . 'plugins/datatables/dataTables.bootstrap.js',
                    $lteJSBase . 'plugins/slimScroll/jquery.slimscroll.js',
                    $jsAssets . 'public/js/adminLTE.js',
                ],
            ],
            'admin_lte_css' => [
                'inputs' => [
                    $lteCssBase . 'bootstrap/css/bootstrap.min.css',
                    $lteCssBase . 'plugins/bootstrap-slider/slider.css',
                    $lteCssBase . 'plugins/datatables/dataTables.bootstrap.css',
                    $cssAssets . 'vendor/fontawesome/css/font-awesome.min.css',
                    $cssAssets . 'vendor/ionicons/css/ionicons.min.css',
                    $lteCssBase . 'dist/css/AdminLTE.css',
                    $lteCssBase . 'dist/css/skins/_all-skins.css',
                ],
            ],
            'admin_lte_forms_js' => [
                'inputs' => [
                    $lteJSBase . 'plugins/colorpicker/bootstrap-colorpicker.js',
                    $lteJSBase . 'plugins/daterangepicker/daterangepicker.js',
                    $lteJSBase . 'plugins/timepicker/bootstrap-timepicker.js',
                    $lteJSBase . 'plugins/input-mask/jquery.inputmask.js',
                    $lteJSBase . 'plugins/iCheck/icheck.js',
                    //   $lteJs.'plugins/input-mask/*',
                ],
            ],
            'admin_lte_forms_css' => [
                'inputs' => [
                    $lteCssBase . 'plugins/colorpicker/bootstrap-colorpicker.css',
                    $lteCssBase . 'plugins/daterangepicker/daterangepicker.css',
                    $lteCssBase . 'plugins/timepicker/bootstrap-timepicker.css',
                    $lteCssBase . 'plugins/iCheck/all.css',
                    $lteCssBase . 'plugins/iCheck/square/_all.css',
                ],
            ],
            'admin_lte_wysiwyg' => [
                'inputs' => [
                    $lteJSBase . 'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
                ],
            ],
            'admin_lte_wysiwyg_css' => [
                'inputs' => [
                    $lteCssBase . 'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
                ],
            ],
            'admin_lte_morris' => [
                'inputs' => [
                    $lteJSBase . 'plugins/morris/morris.js',
                ],
            ],
            'admin_lte_morris_css' => [
                'inputs' => [
                    $lteCssBase . 'plugins/morris/morris.css',
                ],
            ],
            'admin_lte_flot' => [
                'inputs' => [
                    $lteJSBase . 'plugins/flot/*',
                ],
            ],
            'admin_lte_calendar' => [
                'inputs' => [
                    $jsAssets . 'public/vendor/fullcalendar/dist/fullcalendar.min.js',
                ],
            ],
            'admin_lte_calendar_css' => [
                'inputs' => [
                    $cssAssets . 'vendor/fullcalendar/dist/fullcalendar.css',
                ],
            ],
            'avatar_img' => [
                'inputs' => [
                    '@AvanzuAdminThemeBundle/Resources/public/img/avatar.png',
                ],
            ],
            'admin_lte_all' => [
                'inputs' => [
                    '@tools_js',
                    '@admin_lte_forms_js',
                    '@admin_lte_wysiwyg',
                    '@admin_lte_morris',
                    '@admin_lte_calendar',
                    '@admin_lte_js',
                ],
            ],
            'admin_lte_all_css' => [
                'inputs' => [
                    '@admin_lte_css',
                    '@admin_lte_forms_css',
                    '@admin_lte_wysiwyg_css',
                    '@admin_lte_calendar_css',
                    '@admin_lte_morris_css',
                ],
            ],
        ];
    }
);
