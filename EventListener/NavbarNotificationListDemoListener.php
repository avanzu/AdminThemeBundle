<?php
/**
 * NavbarNotificationListDemoListener.php
 * avanzu-admin
 * Date: 23.02.14
 */

namespace Avanzu\AdminThemeBundle\EventListener;


use Avanzu\AdminThemeBundle\Event\NotificationListEvent;
use Avanzu\AdminThemeBundle\Model\NotificationModel;

class NavbarNotificationListDemoListener {


    public function onListNotifications(NotificationListEvent $event) {

        foreach($this->getNotifications() as $notify){
            $event->addNotification($notify);
        }

    }

    protected function getNotifications() {
        return array(
            new NotificationModel('some notification'),
            new NotificationModel('some more notices', 'success'),
        );
    }

}