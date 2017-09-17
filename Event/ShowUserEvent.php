<?php
/**
 * ShowUserEvent.php
 * avanzu-admin
 * Date: 23.02.14
 */

namespace Avanzu\AdminThemeBundle\Event;

use Avanzu\AdminThemeBundle\Model\NavBarUserLink;
use Avanzu\AdminThemeBundle\Model\UserInterface;

class ShowUserEvent extends ThemeEvent
{
    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * @var bool
     */
    protected $showProfileLink = true;

    /**
     * @var bool
     */
    protected $showLogoutLink = true;

    /**
     * @var NavBarUserLink[]
     */
    protected $links = [];

    /**
     * @param \Avanzu\AdminThemeBundle\Model\UserInterface $user
     *
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return \Avanzu\AdminThemeBundle\Model\UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return NavBarUserLink[]
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @param NavBarUserLink $link
     */
    public function addLink(NavBarUserLink $link)
    {
        $this->links[] = $link;
    }

    /**
     * @return boolean
     */
    public function isShowProfileLink()
    {
        return $this->showProfileLink;
    }

    /**
     * @param boolean $showProfileLink
     */
    public function setShowProfileLink($showProfileLink)
    {
        $this->showProfileLink = $showProfileLink;
    }

    /**
     * @return boolean
     */
    public function isShowLogoutLink()
    {
        return $this->showLogoutLink;
    }

    /**
     * @param boolean $showLogoutLink
     */
    public function setShowLogoutLink($showLogoutLink)
    {
        $this->showLogoutLink = $showLogoutLink;
    }
}
