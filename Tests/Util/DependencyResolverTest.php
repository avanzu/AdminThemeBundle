<?php
/**
 * DependencyResolverTest.php
 * publisher
 * Date: 18.04.14
 */

namespace Avanzu\AdminThemeBundle\Tests\Util;


use Avanzu\AdminThemeBundle\Util\DependencyResolver;

class DependencyResolverTest extends \PHPUnit_Framework_TestCase
{

    public function testResolve()
    {

        $items = array(
            'item1'  => array('deps' => null, 'id' => 'item1'),
            'item2'  => array('deps' => null, 'id' => 'item2'),
            'item3'  => array('deps' => array('item2'), 'id' => 'item3'),
            'item4'  => array('deps' => array('item1', 'item3'), 'id' => 'item4'),
            'item5'  => array('deps' => array('item4', 'item6'), 'id' => 'item5'),
            'item6'  => array('deps' => array('item2'), 'id' => 'item6'),
            'item7'  => array('deps' => array('something-odd'), 'id' => 'item7'),
            'item9'  => array('deps' => array('item6', 'item5', 'item4'), 'id' => 'item9'),
            'item10' => array('deps' => array('item9'), 'id' => 'item10'),
            'item11' => array('deps' => array('item1', 'item2', 'item10'), 'id' => 'item11'),

        );


        $expected = array(
            'item1',
            'item2',
            'item3',
            'item4',
            'item6',
            'item5',
            'item9',
            'item10',
            'item11'
        );

        $resolver = new DependencyResolver();
        $resolved = $resolver->register($items)->resolveAll();

        foreach ($expected as $index => $id) {
            assertThat($resolved, hasKeyInArray($index));
            assertThat($resolved[$index]['id'], is(equalTo($id)));
        }
    }


    public function testDetectCircularDependencies() {

        $items = array(
            'item1'  => array('deps' => null, 'id' => 'item1'),
            'item2'  => array('deps' => null, 'id' => 'item2'),
            'item3'  => array('deps' => array('item2'), 'id' => 'item3'),
            'item4'  => array('deps' => array('item1', 'item3'), 'id' => 'item4'),
            'item5'  => array('deps' => array('item4', 'item6', 'item7'), 'id' => 'item5'),
            'item6'  => array('deps' => array('item2'), 'id' => 'item6'),
            'item7'  => array('deps' => array('item1', 'item4', 'item5'), 'id' => 'item7'),
        );

        $resolver = new DependencyResolver();
        $resolver->register($items);

        try {
            $resolver->resolveAll();
        } catch(\Exception $e) {
            assertThat($e, is(anInstanceOf('\RuntimeException')));
        }
    }

}
