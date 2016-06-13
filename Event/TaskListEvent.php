<?php
/**
 * TaskListEvent.php
 * avanzu-admin
 * Date: 23.02.14
 */

namespace Avanzu\AdminThemeBundle\Event;


use Avanzu\AdminThemeBundle\Model\TaskInterface;

class TaskListEvent extends ThemeEvent {

    protected $tasks = array();

    protected $max;

    protected $total = 0;

    /**
     * TaskListEvent constructor.
     *
     * @param $max
     */
    public function __construct($max)
    {
        $this->max = $max;
    }

    /**
     * @return mixed
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
    public function addTask(TaskInterface $taskInterface){
        $this->tasks[]  = $taskInterface;
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
        return $this->total == 0 ? sizeof($this->tasks) : $this->total;
    }



}