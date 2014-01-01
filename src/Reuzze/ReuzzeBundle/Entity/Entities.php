<?php

namespace Reuzze\ReuzzeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entities
 *
 * @ORM\Table(name="entities", indexes={@ORM\Index(name="fk_entities_users1", columns={"user_id"}), @ORM\Index(name="fk_entities_countries1_idx", columns={"region_id"}), @ORM\Index(name="fk_entities_categories1_idx", columns={"category_id"})})
 * @ORM\Entity
 */
class Entities
{
    /**
     * @var integer
     *
     * @ORM\Column(name="entity_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $entityId;

    /**
     * @var string
     *
     * @ORM\Column(name="entity_title", type="string", length=255, nullable=false)
     */
    private $entityTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="entity_description", type="text", nullable=false)
     */
    private $entityDescription;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="entity_starttime", type="datetime", nullable=false)
     */
    private $entityStarttime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="entity_endtime", type="datetime", nullable=false)
     */
    private $entityEndtime;

    /**
     * @var string
     *
     * @ORM\Column(name="entity_instantsellingprice", type="decimal", precision=12, scale=2, nullable=false)
     */
    private $entityInstantsellingprice;

    /**
     * @var string
     *
     * @ORM\Column(name="entity_shippingprice", type="decimal", precision=6, scale=2, nullable=true)
     */
    private $entityShippingprice;

    /**
     * @var string
     *
     * @ORM\Column(name="entity_condition", type="string", nullable=false)
     */
    private $entityCondition;

    /**
     * @var integer
     *
     * @ORM\Column(name="entity_views", type="bigint", nullable=true)
     */
    private $entityViews;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="entity_created", type="datetime", nullable=false)
     */
    private $entityCreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="entity_modified", type="datetime", nullable=true)
     */
    private $entityModified;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="entity_deleted", type="datetime", nullable=true)
     */
    private $entityDeleted;

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
     * @var \Reuzze\ReuzzeBundle\Entity\Regions
     *
     * @ORM\ManyToOne(targetEntity="Reuzze\ReuzzeBundle\Entity\Regions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="region_id", referencedColumnName="region_id")
     * })
     */
    private $region;

    /**
     * @var \Reuzze\ReuzzeBundle\Entity\Categories
     *
     * @ORM\ManyToOne(targetEntity="Reuzze\ReuzzeBundle\Entity\Categories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="category_id")
     * })
     */
    private $category;



    /**
     * Get entityId
     *
     * @return integer 
     */
    public function getEntityId()
    {
        return $this->entityId;
    }

    /**
     * Set entityTitle
     *
     * @param string $entityTitle
     * @return Entities
     */
    public function setEntityTitle($entityTitle)
    {
        $this->entityTitle = $entityTitle;

        return $this;
    }

    /**
     * Get entityTitle
     *
     * @return string 
     */
    public function getEntityTitle()
    {
        return $this->entityTitle;
    }

    /**
     * Set entityDescription
     *
     * @param string $entityDescription
     * @return Entities
     */
    public function setEntityDescription($entityDescription)
    {
        $this->entityDescription = $entityDescription;

        return $this;
    }

    /**
     * Get entityDescription
     *
     * @return string 
     */
    public function getEntityDescription()
    {
        return $this->entityDescription;
    }

    /**
     * Set entityStarttime
     *
     * @param \DateTime $entityStarttime
     * @return Entities
     */
    public function setEntityStarttime($entityStarttime)
    {
        $this->entityStarttime = $entityStarttime;

        return $this;
    }

    /**
     * Get entityStarttime
     *
     * @return \DateTime 
     */
    public function getEntityStarttime()
    {
        return $this->entityStarttime;
    }

    /**
     * Set entityEndtime
     *
     * @param \DateTime $entityEndtime
     * @return Entities
     */
    public function setEntityEndtime($entityEndtime)
    {
        $this->entityEndtime = $entityEndtime;

        return $this;
    }

    /**
     * Get entityEndtime
     *
     * @return \DateTime 
     */
    public function getEntityEndtime()
    {
        return $this->entityEndtime;
    }

    /**
     * Set entityInstantsellingprice
     *
     * @param string $entityInstantsellingprice
     * @return Entities
     */
    public function setEntityInstantsellingprice($entityInstantsellingprice)
    {
        $this->entityInstantsellingprice = $entityInstantsellingprice;

        return $this;
    }

    /**
     * Get entityInstantsellingprice
     *
     * @return string 
     */
    public function getEntityInstantsellingprice()
    {
        return $this->entityInstantsellingprice;
    }

    /**
     * Set entityShippingprice
     *
     * @param string $entityShippingprice
     * @return Entities
     */
    public function setEntityShippingprice($entityShippingprice)
    {
        $this->entityShippingprice = $entityShippingprice;

        return $this;
    }

    /**
     * Get entityShippingprice
     *
     * @return string 
     */
    public function getEntityShippingprice()
    {
        return $this->entityShippingprice;
    }

    /**
     * Set entityCondition
     *
     * @param string $entityCondition
     * @return Entities
     */
    public function setEntityCondition($entityCondition)
    {
        $this->entityCondition = $entityCondition;

        return $this;
    }

    /**
     * Get entityCondition
     *
     * @return string 
     */
    public function getEntityCondition()
    {
        return $this->entityCondition;
    }

    /**
     * Set entityViews
     *
     * @param integer $entityViews
     * @return Entities
     */
    public function setEntityViews($entityViews)
    {
        $this->entityViews = $entityViews;

        return $this;
    }

    /**
     * Get entityViews
     *
     * @return integer 
     */
    public function getEntityViews()
    {
        return $this->entityViews;
    }

    /**
     * Set entityCreated
     *
     * @param \DateTime $entityCreated
     * @return Entities
     */
    public function setEntityCreated($entityCreated)
    {
        $this->entityCreated = $entityCreated;

        return $this;
    }

    /**
     * Get entityCreated
     *
     * @return \DateTime 
     */
    public function getEntityCreated()
    {
        return $this->entityCreated;
    }

    /**
     * Set entityModified
     *
     * @param \DateTime $entityModified
     * @return Entities
     */
    public function setEntityModified($entityModified)
    {
        $this->entityModified = $entityModified;

        return $this;
    }

    /**
     * Get entityModified
     *
     * @return \DateTime 
     */
    public function getEntityModified()
    {
        return $this->entityModified;
    }

    /**
     * Set entityDeleted
     *
     * @param \DateTime $entityDeleted
     * @return Entities
     */
    public function setEntityDeleted($entityDeleted)
    {
        $this->entityDeleted = $entityDeleted;

        return $this;
    }

    /**
     * Get entityDeleted
     *
     * @return \DateTime 
     */
    public function getEntityDeleted()
    {
        return $this->entityDeleted;
    }

    /**
     * Set user
     *
     * @param \Reuzze\ReuzzeBundle\Entity\Users $user
     * @return Entities
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
     * Set region
     *
     * @param \Reuzze\ReuzzeBundle\Entity\Regions $region
     * @return Entities
     */
    public function setRegion(\Reuzze\ReuzzeBundle\Entity\Regions $region = null)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return \Reuzze\ReuzzeBundle\Entity\Regions 
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set category
     *
     * @param \Reuzze\ReuzzeBundle\Entity\Categories $category
     * @return Entities
     */
    public function setCategory(\Reuzze\ReuzzeBundle\Entity\Categories $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Reuzze\ReuzzeBundle\Entity\Categories 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
