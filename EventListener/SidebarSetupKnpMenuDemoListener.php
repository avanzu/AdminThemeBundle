<?php
/**
 * SidebarSetupMenuDemoListener.php
 * avanzu-admin
 * Date: 23.02.14
 */

namespace Avanzu\AdminThemeBundle\EventListener;


use Avanzu\AdminThemeBundle\Event\SidebarKnpMenuEvent;
use Avanzu\AdminThemeBundle\Event\SidebarMenuEvent;
use Avanzu\AdminThemeBundle\Model\MenuItemModel;
use Knp\Menu\MenuFactory;
use Knp\Menu\MenuItem;
use Symfony\Component\HttpFoundation\Request;

class SidebarSetupKnpMenuDemoListener
{

    public function onSetupMenu(SidebarKnpMenuEvent $event)
    {
        $request = $event->getRequest();
        $factory = $event->getFactory();

        foreach ($this->getMenu($request, $factory) as $item) {
            $event->addItem($item);
        }


    }


    protected function getMenu(Request $request, MenuFactory $factory)
    {
        $earg      = array();
        $widgets = $factory->createItem('avanzu_admin_demo',['route' => 'avanzu_admin_demo', 'label' => 'widgets'] );
        $widgets->addChild('avanzu_admin_demo_2', ['route' => 'avanzu_admin_demo_2', 'label' => 'tables']);

        return [
            $factory->createItem('avanzu_admin_dash_demo',['route' => 'avanzu_admin_dash_demo', 'label' => 'dashboard']),
            $factory->createItem('avanzu_admin_form_demo', ['route' => 'avanzu_admin_form_demo', 'label' => 'forms']),
            $widgets
        ];

    }



}