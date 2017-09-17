<?php
/**
 * NavbarShowUserListener.php
 * avanzu-admin
 * Date: 23.02.14
 */

namespace Avanzu\AdminThemeBundle\EventListener;

use Avanzu\AdminThemeBundle\Event\ShowUserEvent;
use Avanzu\AdminThemeBundle\Model\NavBarUserLink;
use Avanzu\AdminThemeBundle\Model\UserModel;

class NavbarShowUserDemoListener
{
    public function onShowUser(ShowUserEvent $event)
    {
        $user = new UserModel();
        $user->setAvatar('')->setIsOnline(true)->setMemberSince(new \DateTime())->setUsername('Demo User');

        $event->setUser($user);

        $event->addLink(new NavBarUserLink('Followers', 'avanzu_admin_home'));
        $event->addLink(new NavBarUserLink('Sales', 'avanzu_admin_home'));
        $event->addLink(new NavBarUserLink('Friends', 'avanzu_admin_home'));
    }
}
