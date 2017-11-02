<?php
/**
 * TaskListEvent.php
 * avanzu-admin
 * Date: 23.02.14
 */

namespace Avanzu\AdminThemeBundle\Event;

use Avanzu\AdminThemeBundle\Model\TaskInterface;

class TaskListEvent extends ThemeEvent
{
    protected $tasks = [];

    protected $max;

    protected $total = 0;

    /**
     * TaskListEvent constructor.
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
    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * @param TaskInterface $taskInterface
     *
     * @return $this
     */
    public function addTask(TaskInterface $taskInterface) {
        $this->tasks[] = $taskInterface;

        return $this;
    }

    /**
     * @param int $total
     *
     * @return $this
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total == 0 ? count($this->tasks) : $this->total;
    }
}
