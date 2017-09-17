<?php
/**
 * MenuBuilder.php
 * symfony3
 * Date: 12.06.16
 */

namespace Avanzu\AdminThemeBundle\Menu;

use Avanzu\AdminThemeBundle\Event\KnpMenuEvent;
use Avanzu\AdminThemeBundle\Event\ThemeEvents;
use Avanzu\AdminThemeBundle\Routing\RouteAliasCollection;
use Knp\Menu\FactoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class MenuBuilder
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @var RouteAliasCollection
     */
    private $aliasCollection;
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * DemoMenuBuilder constructor.
     *
     * @param FactoryInterface         $factory
     * @param RouteAliasCollection     $aliasCollection
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        FactoryInterface $factory,
        RouteAliasCollection $aliasCollection,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->factory = $factory;
        $this->aliasCollection = $aliasCollection;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('root', [
            'childrenAttributes' => ['class' => 'sidebar-menu'],
        ]);

        $childOptions = [
            'attributes' => ['class' => 'treeview'],
            'childrenAttributes' => ['class' => 'treeview-menu'],
            'labelAttributes' => [],
        ];

        $this->eventDispatcher->dispatch(
            ThemeEvents::THEME_SIDEBAR_SETUP_KNP_MENU,
           new KnpMenuEvent($menu, $this->factory, $options, $childOptions)
        );

        return $menu;
    }
}
