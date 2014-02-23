<?php
/**
 * ShowUserEvent.php
 * avanzu-admin
 * Date: 23.02.14
 */

namespace Avanzu\AdminThemeBundle\Event;


use Avanzu\AdminThemeBundle\Model\UserInterface;

class ShowUserEvent extends  ThemeEvent {

    /**
     * @var UserInterface
     */
    protected $user;

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


}