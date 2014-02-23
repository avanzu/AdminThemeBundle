<?php
/**
 * NavbarTaskListDemoListener.php
 * avanzu-admin
 * Date: 23.02.14
 */

namespace Avanzu\AdminThemeBundle\EventListener;


use Avanzu\AdminThemeBundle\Event\TaskListEvent;
use Avanzu\AdminThemeBundle\Model\TaskModel;

class NavbarTaskListDemoListener
{

    public function onListTasks(TaskListEvent $event)
    {

        foreach($this->getTasks() as $task) {
            $event->addTask($task);
        }

    }

    protected function getTasks()
    {
        return array(
         new TaskModel('make stuff', 30, TaskModel::COLOR_GREEN),
         new TaskModel('make more stuff', 60),
         new TaskModel('some more tasks to do', 10, TaskModel::COLOR_RED)
        );

    }

}