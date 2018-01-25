<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Table(name="user_notification_view")
 * @ORM\Entity
 * @ApiResource(
 *     collectionOperations={"get"={"method"="GET"}},
 *     itemOperations={"get"={"method"="GET"}},
 *     attributes={"pagination_enabled"=false, "filters"={"filter.search_user_notification"}}
 *     )
 */
class UserNotification
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $sent_date;
    
    /**
     * @ORM\Column(type="string")
     */
    private $sender_name;

    /**
     * @ORM\Column(type="string")
     */
    private $message;

    /**
     * @ORM\Column(type="string")
     */
    private $store_access;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set sentDate.
     *
     * @param string $sentDate
     *
     * @return UserNotification
     */
    public function setSentDate($sentDate)
    {
        $this->sent_date = $sentDate;

        return $this;
    }

    /**
     * Get sentDate.
     *
     * @return string
     */
    public function getSentDate()
    {
        return $this->sent_date;
    }

    /**
     * Set senderName.
     *
     * @param int $senderName
     *
     * @return UserNotification
     */
    public function setSenderName($senderName)
    {
        $this->sender_name = $senderName;

        return $this;
    }

    /**
     * Get senderName.
     *
     * @return int
     */
    public function getSenderName()
    {
        return $this->sender_name;
    }

    /**
     * Set message.
     *
     * @param string $message
     *
     * @return UserNotification
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set storeAccess.
     *
     * @param string $storeAccess
     *
     * @return UserNotification
     */
    public function setStoreAccess($storeAccess)
    {
        $this->store_access = $storeAccess;

        return $this;
    }

    /**
     * Get storeAccess.
     *
     * @return string
     */
    public function getStoreAccess()
    {
        return $this->store_access;
    }
}
