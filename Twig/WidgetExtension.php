<?php
/**
 * WidgetExtension.php
 * avanzu-admin
 * Date: 17.03.14
 */

namespace Avanzu\AdminThemeBundle\Twig;


use Twig_Environment;

class WidgetExtension extends \Twig_Extension {

    public function renderWidget() {

    }

    public function getFunctions()
    {
        return array(
            'widget_box' => new \Twig_SimpleFunction('widget_box',
                                                     array($this, 'renderWidget'),
                                                     array(
                                                         'is_safe' => array('html'),
                                                         'needs_environment' => true
                                                     )),
        );
    }

    public function getName()
    {
        return 'avanzu_widget';
    }
}
