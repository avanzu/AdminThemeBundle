<?php
/**
 * MessageModel.php
 * avanzu-admin
 * Date: 23.02.14
 */

namespace Avanzu\AdminThemeBundle\Model;

class MessageModel implements MessageInterface
{

    /**
     * @var UserInterface
     */
    protected $from;

    /**
     * @var UserInterface
     */
    protected $to;

    /**
     * @var \DateTime
     */
    protected $sentAt;

    /**
     * @var string
     */
    protected $subject;

    function __construct(UserInterface $from = null, $subject= '', $sentAt = null, UserInterface $to = null)
    {
        $this->to      = $to;
        $this->subject = $subject;
        $this->sentAt  = $sentAt ? : new \DateTime();
        $this->from    = $from;
    }


    /**
     * @param \Avanzu\AdminThemeBundle\Model\UserInterface $from
     *
     * @return $this
     */
    public function setFrom(UserInterface $from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return \Avanzu\AdminThemeBundle\Model\UserInterface
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param \DateTime $sentAt
     *
     * @return $this
     */
    public function setSentAt(\DateTime $sentAt)
    {
        $this->sentAt = $sentAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getSentAt()
    {
        return $this->sentAt;
    }

    /**
     * @param string $subject
     *
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param \Avanzu\AdminThemeBundle\Model\UserInterface $to
     *
     * @return $this
     */
    public function setTo(UserInterface $to)
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @return \Avanzu\AdminThemeBundle\Model\UserInterface
     */
    public function getTo()
    {
        return $this->to;
    }

    public function getIdentifier() {
        return $this->getSubject();
    }

}