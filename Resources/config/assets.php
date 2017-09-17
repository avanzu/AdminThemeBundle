<?php
/**
 * assets.php
 * avanzu-admin
 * Date: 21.03.15
 */

return call_user_func(
    function () {
        $jsAssets = '@AvanzuAdminThemeBundle/Resources/';
        $lteJSBase = $jsAssets . 'public/vendor/adminlte/';
        $cssAssets = 'bundles/avanzuadmintheme/';
        $lteCssBase = $cssAssets . 'vendor/adminlte/';

        return [
            'modernizr_js' => [
                'inputs' => [
                    $jsAssets . 'public/vendor/modernizr/modernizr.js',
                ],
            ],
            'common_js' => [
                'inputs' => [
                    $jsAssets . 'public/vendor/jquery/dist/jquery.js',
                    $jsAssets . 'public/vendor/jquery-ui/jquery-ui.js',
                    $jsAssets . 'public/vendor/underscore/underscore.js',
                    $jsAssets . 'public/vendor/bootstrap/dist/js/bootstrap.min.js',
                    $jsAssets . 'public/vendor/bootbox/bootbox.js',
                    $jsAssets . 'public/js/dialogs.js',
                    $jsAssets . 'public/js/namespace.js',
                ],
            ],
            'tools_js' => [
                'inputs' => [
                    '@common_js',
                    $jsAssets . 'public/vendor/momentjs/moment.js',
                    $jsAssets . 'public/vendor/holderjs/holder.js',
                    $jsAssets . 'public/vendor/spinjs/spin.js',
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
