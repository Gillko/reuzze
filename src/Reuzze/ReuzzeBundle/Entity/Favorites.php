<?php

namespace Reuzze\ReuzzeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Favorites
 *
 * @ORM\Table(name="favorites", indexes={@ORM\Index(name="fk_favorites_entities1_idx", columns={"entity_id"}), @ORM\Index(name="fk_favorites_users1", columns={"user_id"})})
 * @ORM\Entity
 */
class Favorites
{


    /**
     * @var \Reuzze\ReuzzeBundle\Entity\Entities
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="Reuzze\ReuzzeBundle\Entity\Entities")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="entity_id", referencedColumnName="entity_id", unique=true)
     * })
     */
    private $entity;

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
     * Set entity
     *
     * @param \Reuzze\ReuzzeBundle\Entity\Entities $entity
     * @return Favorites
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

    /**
     * Set user
     *
     * @param \Reuzze\ReuzzeBundle\Entity\Users $user
     * @return Favorites
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
}
