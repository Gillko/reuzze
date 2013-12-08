<?php

namespace Reuzze\ReuzzeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Messages
 *
 * @ORM\Table(name="messages", indexes={@ORM\Index(name="fk_messages_users1_idx", columns={"user_id"}), @ORM\Index(name="fk_messages_users2_idx", columns={"friend_id"})})
 * @ORM\Entity
 */
class Messages
{
    /**
     * @var string
     *
     * @ORM\Column(name="message_id", type="string", length=36)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $messageId;

    /**
     * @var string
     *
     * @ORM\Column(name="message_body", type="text", nullable=false)
     */
    private $messageBody;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="message_created", type="datetime", nullable=false)
     */
    private $messageCreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="message_deleted", type="datetime", nullable=true)
     */
    private $messageDeleted;

    /**
     * @var \Reuzze\ReuzzeBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="Reuzze\ReuzzeBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     * })
     */
    private $user;

    /**
     * @var \Reuzze\ReuzzeBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="Reuzze\ReuzzeBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="friend_id", referencedColumnName="user_id")
     * })
     */
    private $friend;



    /**
     * Get messageId
     *
     * @return string 
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * Set messageBody
     *
     * @param string $messageBody
     * @return Messages
     */
    public function setMessageBody($messageBody)
    {
        $this->messageBody = $messageBody;

        return $this;
    }

    /**
     * Get messageBody
     *
     * @return string 
     */
    public function getMessageBody()
    {
        return $this->messageBody;
    }

    /**
     * Set messageCreated
     *
     * @param \DateTime $messageCreated
     * @return Messages
     */
    public function setMessageCreated($messageCreated)
    {
        $this->messageCreated = $messageCreated;

        return $this;
    }

    /**
     * Get messageCreated
     *
     * @return \DateTime 
     */
    public function getMessageCreated()
    {
        return $this->messageCreated;
    }

    /**
     * Set messageDeleted
     *
     * @param \DateTime $messageDeleted
     * @return Messages
     */
    public function setMessageDeleted($messageDeleted)
    {
        $this->messageDeleted = $messageDeleted;

        return $this;
    }

    /**
     * Get messageDeleted
     *
     * @return \DateTime 
     */
    public function getMessageDeleted()
    {
        return $this->messageDeleted;
    }

    /**
     * Set user
     *
     * @param \Reuzze\ReuzzeBundle\Entity\Users $user
     * @return Messages
     */
    public function setUser(\Reuzze\ReuzzeBundle\Entity\Users $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Reuzze\ReuzzeBundle\Entity\Users 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set friend
     *
     * @param \Reuzze\ReuzzeBundle\Entity\Users $friend
     * @return Messages
     */
    public function setFriend(\Reuzze\ReuzzeBundle\Entity\Users $friend = null)
    {
        $this->friend = $friend;

        return $this;
    }

    /**
     * Get friend
     *
     * @return \Reuzze\ReuzzeBundle\Entity\Users 
     */
    public function getFriend()
    {
        return $this->friend;
    }
}
