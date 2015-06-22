<?php
/**
 * assets.php
 * avanzu-admin
 * Date: 21.03.15
 */

return call_user_func(
    function () {
        $jsAssets   = '@AvanzuAdminThemeBundle/Resources/';
        $lteJSBase  = $jsAssets.'public/vendor/adminlte/';
        $cssAssets  = 'bundles/avanzuadmintheme/';
        $lteCssBase = $cssAssets.'vendor/adminlte/';

        return array(
            'modernizr_js' => array(
                'inputs' => array(
                    $jsAssets.'public/vendor/modernizr/modernizr.js',
                )
            ),
            'common_js'              => array(
                'inputs' => array(
                    $jsAssets.'public/vendor/jquery/dist/jquery.js',
                    $jsAssets.'public/vendor/jquery-ui/jquery-ui.js',
                    $jsAssets.'public/vendor/underscore/underscore.js',
                    $jsAssets.'public/vendor/backbone/backbone.js',
                    $jsAssets.'public/vendor/marionette/lib/backbone.marionette.js',
                    $jsAssets.'public/vendor/bootstrap/dist/js/bootstrap.min.js',
                    $jsAssets.'public/vendor/bootbox/bootbox.js',
                    $jsAssets.'public/js/dialogs.js',
                    $jsAssets.'public/js/namespace.js',
                ),
            ),
            'tools_js'               => array(
                'inputs' => array(
                    '@common_js',
                    $jsAssets.'public/vendor/momentjs/moment.js',
                    $jsAssets.'public/vendor/holderjs/holder.js',
                    $jsAssets.'public/vendor/spinjs/spin.js',
                ),
            ),
            'admin_lte_js'           => array(
                'inputs' => array(
                    $lteJSBase.'plugins/bootstrap-slider/bootstrap-slider.js',
                    $lteJSBase.'plugins/datatables/jquery.dataTables.js',
                    $lteJSBase.'plugins/datatables/dataTables.bootstrap.js',
                    $lteJSBase.'plugins/slimScroll/jquery.slimscroll.js',
                    $jsAssets.'public/js/adminLTE.js',
                )
            ),
            'admin_lte_css'          => array(
                'inputs' => array(

                    $lteCssBase.'bootstrap/css/bootstrap.min.css',
                    $lteCssBase.'plugins/bootstrap-slider/slider.css',
                    $lteCssBase.'plugins/datatables/dataTables.bootstrap.css',
                    $cssAssets.'vendor/fontawesome/css/font-awesome.min.css',
                    $cssAssets.'vendor/ionicons/css/ionicons.min.css',
                    $lteCssBase.'dist/css/AdminLTE.css',
                    $lteCssBase.'dist/css/skins/_all-skins.css',
                )
            ),
            'admin_lte_forms_js'     => array(
                'inputs' => array(
                    $lteJSBase.'plugins/colorpicker/bootstrap-colorpicker.js',
                    $lteJSBase.'plugins/daterangepicker/daterangepicker.js',
                    $lteJSBase.'plugins/timepicker/bootstrap-timepicker.js',
                    $lteJSBase.'plugins/input-mask/jquery.inputmask.js',
                    $lteJSBase.'plugins/iCheck/icheck.js'
                    //   $lteJs.'plugins/input-mask/*',
                )
            ),
            'admin_lte_forms_css'    => array(
                'inputs' => array(
                    $lteCssBase.'plugins/colorpicker/bootstrap-colorpicker.css',
                    $lteCssBase.'plugins/daterangepicker/daterangepicker-bs3.css',
                    $lteCssBase.'plugins/timepicker/bootstrap-timepicker.css',
                    $lteCssBase.'plugins/iCheck/all.css',
                    $lteCssBase.'plugins/iCheck/square/_all.css',
                )
            ),
            'admin_lte_wysiwyg'      => array(
                'inputs' => array(
                    $lteJSBase.'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
                )
            ),
            'admin_lte_wysiwyg_css'  => array(
                'inputs' => array(
                    $lteCssBase.'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
                )
            ),
            'admin_lte_morris'       => array(
                'inputs' => array(
                    $lteJSBase.'plugins/morris/morris.js',
                )
            ),
            'admin_lte_morris_css'   => array(
                'inputs' => array(
                    $lteCssBase.'plugins/morris/morris.css',
                )
            ),
            'admin_lte_flot'         => array(
                'inputs' => array(
                    $lteJSBase.'plugins/flot/*',
                )
            ),
            'admin_lte_calendar'     => array(
                'inputs' => array(
                    $jsAssets.'public/vendor/fullcalendar/dist/fullcalendar.min.js',
                )
            ),
            'admin_lte_calendar_css' => array(
                'inputs' => array(
                    $cssAssets.'vendor/fullcalendar/dist/fullcalendar.css',
                )
            ),
            'avatar_img'             => array(
                'inputs' => array(
                    '@AvanzuAdminThemeBundle/Resources/public/img/avatar.png'
                )
            ),
            'admin_lte_all'          => array(
                'inputs' => array(
                    '@tools_js',
                    '@admin_lte_forms_js',
                    '@admin_lte_wysiwyg',
                    '@admin_lte_morris',
                    '@admin_lte_calendar',
                    '@admin_lte_js',
                )
            ),
            'admin_lte_all_css'      => array(
                'inputs' => array(
                    '@admin_lte_css',
                    '@admin_lte_forms_css',
                    '@admin_lte_wysiwyg_css',
                    '@admin_lte_calendar_css',
                    '@admin_lte_morris_css',
                )
            )

        );
    }
);
