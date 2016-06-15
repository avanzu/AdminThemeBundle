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
use Symfony\Component\EventDispatcher\EventDispatcher;
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
        $this->factory         = $factory;
        $this->aliasCollection = $aliasCollection;
        $this->eventDispatcher = $eventDispatcher;
    }


    public function createMainMenu(array $options)
    {
        
        $menu = $this->factory->createItem('root', array(
            'childrenAttributes' => array('class' => 'sidebar-menu')
        ));

        $childOptions = array(
            'attributes'         => array('class' => 'treeview'),
            'childrenAttributes' => array('class' => 'treeview-menu'),
            'labelAttributes'    => array()
        );

        $this->eventDispatcher->dispatch(
            ThemeEvents::THEME_SIDEBAR_SETUP_KNP_MENU,
           new KnpMenuEvent( $menu, $this->factory, $options, $childOptions )
        );


        return $menu;
    }


}