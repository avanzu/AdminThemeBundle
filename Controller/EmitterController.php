<?php
/**
 * EmitterController.php
 * symfony3
 * Date: 13.06.16
 */

namespace Avanzu\AdminThemeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\EventDispatcher\Event;

class EmitterController extends Controller
{
    /**
     * @return \Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher|\Symfony\Component\HttpKernel\Debug\TraceableEventDispatcher
     */
    protected function getDispatcher()
    {
        return $this->get('event_dispatcher');
    }

    /**
     * @param $eventName
     *
     * @return bool
     */
    protected function hasListener($eventName)
    {
        return $this->getDispatcher()->hasListeners($eventName);
    }

    /**
     * Will look for a method of the format "on<CamelizedEventName>" and call it with the event as argument.
     *
     *
     * Then it will dispatch the event as normal via the event dispatcher.
     *
     * @param       $eventName
     * @param Event $event
     *
     * @return Event
     */
    protected function triggerMethod($eventName, Event $event)
    {
        $method = sprintf('on%s', Container::camelize(str_replace('.', '_', $eventName)));

        if(is_callable([$this, $method])) {
            call_user_func_array([$this, $method], [$event]);
        }

        if($event->isPropagationStopped()){
            return $event;
        }

        $this->getDispatcher()->dispatch($eventName, $event);

        return $event;
    }
}
