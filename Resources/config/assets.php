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
                        $jsAssets . 'bower/bower_components/adminlte/dist/js/app.min.js',
                    ],
                ],
                'admin_lte_css' => [
                    'inputs' => [
                        $jsAssets . 'bower/bower_components/adminlte/bootstrap/css/bootstrap.min.css',
                        $jsAssets . 'bower/bower_components/adminlte/plugins/bootstrap-slider/slider.css',
                        $jsAssets . 'bower/bower_components/adminlte/plugins/datatables/dataTables.bootstrap.css',
                        $jsAssets . 'bower/bower_components/fontawesome/css/font-awesome.min.css',
                        $jsAssets . 'bower/bower_components/ionicons/css/ionicons.min.css',
                        $jsAssets . 'bower/bower_components/adminlte/dist/css/AdminLTE.min.css',
                        $jsAssets . 'bower/bower_components/adminlte/dist/css/skins/_all-skins.min.css',
                    ],
                ],
                'admin_lte_fonts' => [
                    'inputs' => [
                        $jsAssets . 'bower/bower_components/adminlte/bootstrap/fonts/glyphicons-halflings-regular.eot',
                        $jsAssets . 'bower/bower_components/adminlte/bootstrap/fonts/glyphicons-halflings-regular.svg',
                        $jsAssets . 'bower/bower_components/adminlte/bootstrap/fonts/glyphicons-halflings-regular.ttf',
                        $jsAssets . 'bower/bower_components/adminlte/bootstrap/fonts/glyphicons-halflings-regular.woff',
                        $jsAssets . 'bower/bower_components/adminlte/bootstrap/fonts/glyphicons-halflings-regular.woff2',
                        $jsAssets . 'bower/bower_components/fontawesome/fonts/FontAwesome.otf',
                        $jsAssets . 'bower/bower_components/fontawesome/fonts/fontawesome-webfont.eot',
                        $jsAssets . 'bower/bower_components/fontawesome/fonts/fontawesome-webfont.svg',
                        $jsAssets . 'bower/bower_components/fontawesome/fonts/fontawesome-webfont.ttf',
                        $jsAssets . 'bower/bower_components/fontawesome/fonts/fontawesome-webfont.woff',
                        $jsAssets . 'bower/bower_components/fontawesome/fonts/fontawesome-webfont.woff2',
                        $jsAssets . 'bower/bower_components/ionicons/fonts/ionicons.eot',
                        $jsAssets . 'bower/bower_components/ionicons/fonts/ionicons.svg',
                        $jsAssets . 'bower/bower_components/ionicons/fonts/ionicons.ttf',
                        $jsAssets . 'bower/bower_components/ionicons/fonts/ionicons.woff',
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
                        $jsAssets . 'bower/bower_components/adminlte/plugins/colorpicker/bootstrap-colorpicker.css',
                        $jsAssets . 'bower/bower_components/adminlte/plugins/daterangepicker/daterangepicker.css',
                        $jsAssets . 'bower/bower_components/adminlte/plugins/timepicker/bootstrap-timepicker.css',
                        $jsAssets . 'bower/bower_components/adminlte/plugins/iCheck/all.css',
                        $jsAssets . 'bower/bower_components/adminlte/plugins/iCheck/square/_all.css',
                    ],
                ],
                'admin_lte_wysiwyg' => [
                    'inputs' => [
                        $jsAssets . 'bower/bower_components/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
                    ],
                ],
                'admin_lte_wysiwyg_css' => [
                    'inputs' => [
                        $jsAssets . 'bower/bower_components/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
                    ],
                ],
                'admin_lte_morris' => [
                    'inputs' => [
                        $jsAssets . 'bower/bower_components/adminlte/plugins/morris/morris.js',
                    ],
                ],
                'admin_lte_morris_css' => [
                    'inputs' => [
                        $jsAssets . 'bower/bower_components/adminlte/plugins/morris/morris.css',
                    ],
                ],
                'admin_lte_flot' => [
                    'inputs' => [
                        $jsAssets . 'bower/bower_components/adminlte/plugins/flot/*',
                    ],
                ],
                'admin_lte_calendar' => [
                    'inputs' => [
                        $jsAssets . 'bower/bower_components/fullcalendar/dist/fullcalendar.min.js',
                    ],
                ],
                'admin_lte_calendar_css' => [
                    'inputs' => [
                        $jsAssets . 'bower/bower_components/fullcalendar/dist/fullcalendar.css',
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
