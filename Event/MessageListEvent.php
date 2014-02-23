<?php
/**
 * MessageListEvent.php
 * avanzu-admin
 * Date: 23.02.14
 */

namespace Avanzu\AdminThemeBundle\Event;


use Avanzu\AdminThemeBundle\Model\MessageInterface;

/**
 * Class MessageListEvent
 *
 * @package Avanzu\AdminThemeBundle\Event
 */
class MessageListEvent extends ThemeEvent
{

    /**
     * @var array
     */
    protected $messages = array();

    /**
     * @var int
     */
    protected $totalMessages = 0;

    /**
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @param MessageInterface $messageInterface
     *
     * @return $this
     */
    public function addMessage(MessageInterface $messageInterface)
    {

        $this->messages[] = $messageInterface;

        return $this;

    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->totalMessages == 0 ? sizeof($this->messages) : $this->totalMessages;
    }

}