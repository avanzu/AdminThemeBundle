<?php
/**
 * SidebarKnpMenuEvent.php
 * symfony3
 * Date: 12.06.16
 */

namespace Avanzu\AdminThemeBundle\Event;


use Knp\Menu\MenuFactory;
use Knp\Menu\MenuItem;

/**
 * Class SidebarKnpMenuEvent
 * @property MenuItem $menuRootItems
 */
class SidebarKnpMenuEvent extends SidebarMenuEvent
{

    /**
     * @var MenuFactory
     */
    protected $factory;

    /**
     * SidebarKnpMenuEvent constructor.
     *
     * @param null $request
     * @param MenuFactory $factory
     */
    public function __construct($request, $factory)
    {
        parent::__construct($request);
        $this->factory       = $factory;
        $this->menuRootItems = $factory->createItem('root');
    }

    /**
     * @return MenuItem
     */
    public function getMenuRootItems()
    {
        return $this->menuRootItems;
    }

    /**
     * @return MenuFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }

    public function addItem($item)
    {
        $this->menuRootItems->addChild($item);
    }

}