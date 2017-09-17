<?php
/**
 * SidebarMenuEvent.php
 * avanzu-admin
 * Date: 23.02.14
 */

namespace Avanzu\AdminThemeBundle\Event;

use Avanzu\AdminThemeBundle\Model\MenuItemInterface;
use Knp\Menu\MenuItem;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class SidebarMenuEvent
 *
 * @package Avanzu\AdminThemeBundle\Event
 */
class SidebarMenuEvent extends ThemeEvent
{
    /**
     * @var array
     */
    protected $menuRootItems = [];

    /**
     * @var Request
     */
    protected $request;

    public function __construct($request = null)
    {
        $this->request = $request;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->menuRootItems;
    }

    /**
     * @param MenuItemInterface|MenuItem $item
     */
    public function addItem($item)
    {
        $this->menuRootItems[$item->getIdentifier()] = $item;
    }

    /**
     * @param $id
     *
     * @return null
     */
    public function getRootItem($id)
    {
        return isset($this->menuRootItems[$id]) ? $this->menuRootItems[$id] : null;
    }

    /**
     * @return MenuItemInterface|null
     */
    public function getActive() {
        foreach($this->getItems() as $item) { /** @var $item MenuItemInterface */
            if($item->isActive()) return $item;
        }

        return null;
    }
}
