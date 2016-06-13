<?php
/**
 * EmitterControllerTest.php
 * symfony3
 * Date: 13.06.16
 */

namespace Avanzu\AdminThemeBundle\Tests\Controller;


use Avanzu\AdminThemeBundle\Controller\EmitterController;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class TestEmitterController extends EmitterController {

    public function onTestSomeEvent(Event $event)
    {
        $event->onTestSomeEvent = true;
        return $event;
    }

    public function onTestStoppingEvent(Event $event)
    {
        $event->stopPropagation();
    }

    public function executeAction($eventName, $event)
    {
        if( $this->hasListener($eventName)) {
            $this->triggerMethod($eventName, $event);
        }

        return $event;
    }
}

class EmitterControllerTest extends KernelTestCase
{


    /**
     * @test
     */
    public function itShouldTriggerMethods()
    {
        $event      = new Event();
        $dispatcher = $this->getDispatcher(['test.some_event' => true], ['test.some_event' => $event]);
        $container  = $this->getContainer(['event_dispatcher' => $dispatcher->reveal()]);

        $controller = new TestEmitterController();
        $controller->setContainer($container);
        $result = $controller->executeAction('test.some_event', $event);

        $this->assertSame($event, $result);
        $this->assertObjectHasAttribute('onTestSomeEvent', $result);

    }

    /**
     * @test
     */
    public function itShouldNotTriggerEventsOnStoppedPropagation()
    {
        $event      = new Event();
        $dispatcher = $this->getDispatcher(['test.stopping_event' => true],['test.stopping_event' => false]);
        $container  = $this->getContainer(['event_dispatcher' => $dispatcher->reveal()]);

        $controller = new TestEmitterController();
        $controller->setContainer($container);
        $result = $controller->executeAction('test.stopping_event', $event);

        $this->assertSame($event, $result);
        $this->assertTrue($result->isPropagationStopped());

    }


    protected function setUp()
    {
        static::bootKernel();
    }

    protected function getContainer($doubles = [])
    {
        $container = static::$kernel->getContainer();
        foreach($doubles as $id => $object) {
            $container->set($id, $object);
        }

        return $container;
    }

    private function getDispatcher($knonwEvents = [], $expectedTriggers = [])
    {
        /** @var  ObjectProphecy|EventDispatcherInterface $dispatcher */
        $dispatcher = $this->prophesize(EventDispatcherInterface::class);
        foreach ($knonwEvents as $event => $available) {

            $dispatcher->hasListeners($event)->shouldBeCalled()->willReturn($available);

            if( ! $available ) {
                $dispatcher->dispatch($event, Argument::type(Event::class))->shouldNotBeCalled();
            }

        }

        foreach ( $expectedTriggers as $event => $object ) {

            if( $object === false ) {
                $dispatcher->dispatch($event, Argument::type(Event::class))->shouldNotBeCalled();
            } else {
                $dispatcher->dispatch($event, $object)->shouldBeCalled()->willReturn($object);
            }
        }

        return $dispatcher;
    }

}
