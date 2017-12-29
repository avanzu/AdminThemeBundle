<?php
/**
 * KnpMneuEvent.php
 * symfony3
 * Date: 13.06.16
 */

namespace Avanzu\AdminThemeBundle\Event;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Knp\Menu\MenuFactory;
use Knp\Menu\MenuItem;

class KnpMenuEvent extends ThemeEvent
{
    /**
     * @var ItemInterface
     */
    protected $menu;
    /**
     * @var FactoryInterface
     */
    protected $factory;
    /**
     * @var array
     */
    private $options;
    /**
     * @var array
     */
    private $childOptions;

    /**
     * KnpMneuEvent constructor.
     *
     * @param ItemInterface    $menu
     * @param FactoryInterface $factory
     * @param array            $options
     * @param array            $childOptions
     */
    public function __construct($menu, $factory, $options = [], $childOptions = [])
    {
        $this->menu = $menu;
        $this->factory = $factory;
        $this->options = $options;
        $this->childOptions = $childOptions;
    }

    /**
     * @return MenuItem
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * @return MenuFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @return array
     */
    public function getChildOptions()
    {
        return $this->childOptions;
    }
}
