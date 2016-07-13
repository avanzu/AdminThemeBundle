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
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Response;

class NavbarController extends EmitterController
{

    /**
     * @param int $max
     *
     * @return Response
     */
    public function notificationsAction($max = 5)
    {

        if (!$this->hasListener(ThemeEvents::THEME_NOTIFICATIONS)) {
            return new Response();
        }

        $listEvent = $this->triggerMethod(ThemeEvents::THEME_NOTIFICATIONS, new NotificationListEvent($max));

        return $this->render(
            'AvanzuAdminThemeBundle:Navbar:notifications.html.twig',
            array(

                'notifications' => $listEvent->getNotifications(),
                'total'         => $listEvent->getTotal(),
            )
        );

    }

    /**
     * @param int $max
     *
     * @return Response
     */
    public function messagesAction($max = 5)
    {

        if (!$this->hasListener(ThemeEvents::THEME_MESSAGES)) {
            return new Response();
        }

        $listEvent = $this->triggerMethod(ThemeEvents::THEME_MESSAGES, new MessageListEvent($max));

        return $this->render(
            'AvanzuAdminThemeBundle:Navbar:messages.html.twig',
            array(
                'messages' => $listEvent->getMessages(),
                'total'    => $listEvent->getTotal(),
            )
        );
    }

    /**
     * @param int $max
     *
     * @return Response
     */
    public function tasksAction($max = 5)
    {

        if (!$this->hasListener(ThemeEvents::THEME_TASKS)) {
            return new Response();
        }

        $listEvent = $this->triggerMethod(ThemeEvents::THEME_TASKS, new TaskListEvent($max));

        return $this->render(
            'AvanzuAdminThemeBundle:Navbar:tasks.html.twig',
            array(
                'tasks' => $listEvent->getTasks(),
                'total' => $listEvent->getTotal(),
            )
        );
    }

    /**
     * @return Response
     */
    public function userAction()
    {

        if (!$this->hasListener(ThemeEvents::THEME_NAVBAR_USER)) {
            return new Response();
        }

        /** @var ShowUserEvent $userEvent */
        $userEvent = $this->triggerMethod(ThemeEvents::THEME_NAVBAR_USER, new ShowUserEvent());

        if ($userEvent instanceof ShowUserEvent) {
            return $this->render(
                'AvanzuAdminThemeBundle:Navbar:user.html.twig',
                [
                    'user'            => $userEvent->getUser(),
                    'links'           => $userEvent->getLinks(),
                    'showProfileLink' => $userEvent->isShowProfileLink(),
                    'showLogoutLink'  => $userEvent->isShowLogoutLink(),
                ]
            );
        }

        return new Response();
    }

}