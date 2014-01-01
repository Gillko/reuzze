<?php

namespace Reuzze\ReuzzeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Media
 *
 * @ORM\Table(name="media", indexes={@ORM\Index(name="fk_media_entities1", columns={"entity_id"})})
 * @ORM\Entity
 */
class Media
{
    /**
     * @var integer
     *
     * @ORM\Column(name="medium_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $mediumId;

    /**
     * @var string
     *
     * @ORM\Column(name="medium_url", type="string", length=255, nullable=false)
     */
    private $mediumUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="medium_type", type="string", length=3, nullable=false)
     */
    private $mediumType;

    /**
     * @var string
     *
     * @ORM\Column(name="medium_mimetype", type="string", length=255, nullable=false)
     */
    private $mediumMimetype;

    /**
     * @var boolean
     *
     * @ORM\Column(name="medium_isexternal", type="boolean", nullable=true)
     */
    private $mediumIsexternal;

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
     * Get mediumId
     *
     * @return integer 
     */
    public function getMediumId()
    {
        return $this->mediumId;
    }

    /**
     * Set mediumUrl
     *
     * @param string $mediumUrl
     * @return Media
     */
    public function setMediumUrl($mediumUrl)
    {
        $this->mediumUrl = $mediumUrl;

        return $this;
    }

    /**
     * Get mediumUrl
     *
     * @return string 
     */
    public function getMediumUrl()
    {
        return $this->mediumUrl;
    }

    /**
     * Set mediumType
     *
     * @param string $mediumType
     * @return Media
     */
    public function setMediumType($mediumType)
    {
        $this->mediumType = $mediumType;

        return $this;
    }

    /**
     * Get mediumType
     *
     * @return string 
     */
    public function getMediumType()
    {
        return $this->mediumType;
    }

    /**
     * Set mediumMimetype
     *
     * @param string $mediumMimetype
     * @return Media
     */
    public function setMediumMimetype($mediumMimetype)
    {
        $this->mediumMimetype = $mediumMimetype;

        return $this;
    }

    /**
     * Get mediumMimetype
     *
     * @return string 
     */
    public function getMediumMimetype()
    {
        return $this->mediumMimetype;
    }

    /**
     * Set mediumIsexternal
     *
     * @param boolean $mediumIsexternal
     * @return Media
     */
    public function setMediumIsexternal($mediumIsexternal)
    {
        $this->mediumIsexternal = $mediumIsexternal;

        return $this;
    }

    /**
     * Get mediumIsexternal
     *
     * @return boolean 
     */
    public function getMediumIsexternal()
    {
        return $this->mediumIsexternal;
    }

    /**
     * Set entity
     *
     * @param \Reuzze\ReuzzeBundle\Entity\Entities $entity
     * @return Media
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
