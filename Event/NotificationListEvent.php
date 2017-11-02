<?php
/**
 * NotificationListEvent.php
 * avanzu-admin
 * Date: 23.02.14
 */

namespace Avanzu\AdminThemeBundle\Event;

use Avanzu\AdminThemeBundle\Model\NotificationInterface;

/**
 * Class NotificationListEvent
 *
 * @package Avanzu\AdminThemeBundle\Event
 */
class NotificationListEvent extends ThemeEvent
{
    /**
     * @var array
     */
    protected $notifications = [];

    protected $total = 0;

    protected $max = null;

    /**
     * NotificationListEvent constructor.
     *
     * @param integer $max Maximun number of notifications displayed in panel
     */
    public function __construct($max = NULL)
    {
        $this->max = $max;
    }

    /**
     * Get the maximun number of notifications displayed in panel
     * 
     * @return integer
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * @return array
     */
    public function getNotifications()
    {
        return $this->notifications;
    }

    /**
     * @param NotificationInterface $notificationInterface
     *
     * @return $this
     */
    public function addNotification(NotificationInterface $notificationInterface)
    {
        $this->notifications[] = $notificationInterface;

        return $this;
    }

    /**
     * @param int $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total == 0 ? count($this->notifications) : $this->total;
    }
}
