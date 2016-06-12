<?php
/**
 * MenuBuilder.php
 * symfony3
 * Date: 12.06.16
 */

namespace Avanzu\AdminThemeBundle\Menu;


use Knp\Menu\FactoryInterface;
use Knp\Menu\Iterator\CurrentItemFilterIterator;
use Knp\Menu\Iterator\RecursiveItemIterator;
use Knp\Menu\Matcher\MatcherInterface;
use Knp\Menu\MenuItem;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class DemoMenuBuilder
{

    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * MenuBuilder constructor.
     *
     * @param FactoryInterface         $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('root', array(
            'childrenAttributes' => array(
                'class' => 'sidebar-menu'
            )
        ));



        $childOptions = array(
            'attributes' => array(
                'class' => 'treeview'
            ),
            'childrenAttributes' => array(
                'class' => 'treeview-menu'
            ),
            'labelAttributes'    => array(

            )
        );

        $labelAttributes = ['icon' => 'fa fa-circle-o'];

        $dashbard = $menu->addChild('Dashboard', ['route' => 'avanzu_admin_dash_demo'])
                         ->setLabelAttribute('icon', 'fa fa-dashboard');

        $examples = $menu->addChild('Examples', $childOptions)->setLabelAttribute('icon', 'fa fa-list');
        $examples->addChild('Subdash', ['route' => 'avanzu_admin_demo_2', 'labelAttributes' => $labelAttributes]);
        $examples->addChild('Forms', ['route' =>'avanzu_admin_form_demo', 'labelAttributes' => $labelAttributes]);
        $examples->addChild('Login', ['route' => 'avanzu_admin_login_demo', 'labelAttributes' => $labelAttributes]);

        $ui = $menu->addChild('Widgets', $childOptions)->setLabelAttribute('icon', 'fa fa-th');
        $ui->addChild('General', ['route' => 'avanzu_admin_ui_gen_demo' , 'labelAttributes' => $labelAttributes]);
        $ui->addChild('icons', ['route' => 'avanzu_admin_ui_icon_demo', 'labelAttributes' => $labelAttributes]);

        return $menu;
    }


}