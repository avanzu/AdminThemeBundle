<?php
/**
 * NavbarController.php
 * avanzu-admin
 * Date: 23.02.14
 */

namespace Avanzu\AdminThemeBundle\Controller;

use Avanzu\AdminThemeBundle\Event\MessageListEvent;
use Avanzu\AdminThemeBundle\Event\NotificationListEvent;
use Avanzu\AdminThemeBundle\Event\ShowUserEvent;
use Avanzu\AdminThemeBundle\Event\TaskListEvent;
use Avanzu\AdminThemeBundle\Event\ThemeEvents;
use Avanzu\AdminThemeBundle\Controller\EmitterController;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Response;

class NavbarController extends EmitterController
{
    const MAX_NOTIFICATIONS = 5;
    const MAX_MESSAGES = 5;
    const MAX_TASKS = 5;

    /**
     * @return EventDispatcher
     */
    protected function getDispatcher()
    {
        return $this->get('event_dispatcher');
    }

    public function notificationsAction($max = self::MAX_NOTIFICATIONS)
    {
        if (!$this->getDispatcher()->hasListeners(ThemeEvents::THEME_NOTIFICATIONS)) {
            return new Response();
        }

        $listEvent = $this->getDispatcher()->dispatch(ThemeEvents::THEME_NOTIFICATIONS, new NotificationListEvent());

        return $this->render(
                    'AvanzuAdminThemeBundle:Navbar:notifications.html.twig',
                        [
                            'notifications' => $listEvent->getNotifications(),
                            'total' => $listEvent->getTotal(),
                        ]
        );
    }

    /**
     * @param int $max
     *
     * @return Response
     */
    public function messagesAction($max = self::MAX_MESSAGES)
    {
        if (!$this->getDispatcher()->hasListeners(ThemeEvents::THEME_MESSAGES)) {
            return new Response();
        }

        $listEvent = $this->getDispatcher()->dispatch(ThemeEvents::THEME_MESSAGES, new MessageListEvent());

        return $this->render(
                    'AvanzuAdminThemeBundle:Navbar:messages.html.twig',
                        [
                            'messages' => $listEvent->getMessages(),
                            'total' => $listEvent->getTotal(),
                        ]
        );
    }

    /**
     * @param int $max
     *
     * @return Response
     */
    public function tasksAction($max = self::MAX_TASKS)
    {
        if (!$this->getDispatcher()->hasListeners(ThemeEvents::THEME_TASKS)) {
            return new Response();
        }

        $listEvent = $this->triggerMethod(ThemeEvents::THEME_TASKS, new TaskListEvent($max));

        return $this->render(
                    'AvanzuAdminThemeBundle:Navbar:tasks.html.twig',
                        [
                            'tasks' => $listEvent->getTasks(),
                            'total' => $listEvent->getTotal(),
                        ]
        );
    }

    /**
     * @return Response
     */
    public function userAction()
    {
        if (!$this->getDispatcher()->hasListeners(ThemeEvents::THEME_NAVBAR_USER)) {
            return new Response();
        }

        /** @var ShowUserEvent $userEvent */
        $userEvent = $this->triggerMethod(ThemeEvents::THEME_NAVBAR_USER, new ShowUserEvent());

        if ($userEvent instanceof ShowUserEvent) {
            return $this->render(
                'AvanzuAdminThemeBundle:Navbar:user.html.twig',
                [
                    'user' => $userEvent->getUser(),
                    'links' => $userEvent->getLinks(),
                    'showProfileLink' => $userEvent->isShowProfileLink(),
                    'showLogoutLink' => $userEvent->isShowLogoutLink(),
                ]
            );
        }

        return new Response();
    }
}
