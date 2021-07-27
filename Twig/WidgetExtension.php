<?php
/**
 * WidgetExtension.php
 * avanzu-admin
 * Date: 17.03.14
 */

namespace Avanzu\AdminThemeBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class WidgetExtension extends AbstractExtension
{
    public function renderWidget() {
    }

    public function getFunctions()
    {
        return [
            'widget_box' => new TwigFilter('widget_box',
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
