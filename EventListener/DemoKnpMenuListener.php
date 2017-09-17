<?php
/**
 * KnpMenuListener.php
 * symfony3
 * Date: 13.06.16
 */

namespace Avanzu\AdminThemeBundle\EventListener;

use Avanzu\AdminThemeBundle\Event\KnpMenuEvent;

class DemoKnpMenuListener
{
    /**
     * @param KnpMenuEvent $event
     */
    public function onSetupKnpMenu(KnpMenuEvent $event)
    {
        $menu = $event->getMenu();
        $factory = $event->getFactory();
        $childOptions = $event->getChildOptions();
        $labelAttributes = ['icon' => 'fa fa-circle-o'];

        $dashbard = $menu->addChild('Dashboard', ['route' => 'avanzu_admin_home'])
                         ->setLabelAttribute('icon', 'fa fa-dashboard');

        $examples = $menu->addChild('Examples', $childOptions)->setLabelAttribute('icon', 'fa fa-list');
        $examples->addChild('Subdash', ['route' => 'avanzu_admin_demo_2', 'labelAttributes' => $labelAttributes]);
        $examples->addChild('Forms', ['route' => 'avanzu_admin_form_demo', 'labelAttributes' => $labelAttributes]);
        $examples->addChild('Login', ['route' => 'avanzu_admin_login_demo', 'labelAttributes' => $labelAttributes]);

        $ui = $menu->addChild('Widgets', $childOptions)->setLabelAttribute('icon', 'fa fa-th');
        $ui->addChild('General', ['route' => 'avanzu_admin_ui_gen_demo', 'labelAttributes' => $labelAttributes]);
        $ui->addChild('icons', ['route' => 'avanzu_admin_ui_icon_demo', 'labelAttributes' => $labelAttributes]);
    }
}
