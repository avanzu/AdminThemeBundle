<?php
/**
 * WidgetExtension.php
 * avanzu-admin
 * Date: 17.03.14
 */

namespace Avanzu\AdminThemeBundle\Twig;

class WidgetExtension extends \Twig_Extension
{
    public function renderWidget() {
    }

    public function getFunctions()
    {
        return [
            'widget_box' => new \Twig_SimpleFunction('widget_box',
                                                     [$this, 'renderWidget'],
                                                     [
                                                         'is_safe' => ['html'],
                                                         'needs_environment' => true,
                                                     ]),
        ];
    }

    public function getName()
    {
        return 'avanzu_widget';
    }
}
