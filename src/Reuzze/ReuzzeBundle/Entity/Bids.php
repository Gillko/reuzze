<?php

namespace Reuzze\ReuzzeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bids
 *
 * @ORM\Table(name="bids", indexes={@ORM\Index(name="fk_bids_users1_idx", columns={"user_id"}), @ORM\Index(name="fk_bids_entities1_idx", columns={"entity_id"})})
 * @ORM\Entity
 */
class Bids
{
    /**
     * @var integer
     *
     * @ORM\Column(name="bid_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $bidId;

    /**
     * @var string
     *
     * @ORM\Column(name="bid_amount", type="decimal", precision=12, scale=2, nullable=false)
     */
    private $bidAmount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="bid_date", type="datetime", nullable=false)
     */
    private $bidDate;

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
     * @var \Reuzze\ReuzzeBundle\Entity\Entities
     *
     * @ORM\ManyToOne(targetEntity="Reuzze\ReuzzeBundle\Entity\Entities")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="entity_id", referencedColumnName="entity_id")
     * })
     */
    private $entity;



    /**
     * Get bidId
     *
     * @return integer 
     */
    public function getBidId()
    {
        return $this->bidId;
    }

    /**
     * Set bidAmount
     *
     * @param string $bidAmount
     * @return Bids
     */
    public function setBidAmount($bidAmount)
    {
        $this->bidAmount = $bidAmount;

        return $this;
    }

    /**
     * Get bidAmount
     *
     * @return string 
     */
    public function getBidAmount()
    {
        return $this->bidAmount;
    }

    /**
     * Set bidDate
     *
     * @param \DateTime $bidDate
     * @return Bids
     */
    public function setBidDate($bidDate)
    {
        $this->bidDate = $bidDate;

        return $this;
    }

    /**
     * Get bidDate
     *
     * @return \DateTime 
     */
    public function getBidDate()
    {
        return $this->bidDate;
    }

    /**
     * Set user
     *
     * @param \Reuzze\ReuzzeBundle\Entity\Users $user
     * @return Bids
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
     * Set entity
     *
     * @param \Reuzze\ReuzzeBundle\Entity\Entities $entity
     * @return Bids
     */
    public function setEntity(\Reuzze\ReuzzeBundle\Entity\Entities $entity = null)
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * Get entity
     *
     * @return \Reuzze\ReuzzeBundle\Entity\Entities 
     */
    public function getEntity()
    {
        return $this->entity;
    }
}
