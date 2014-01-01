<?php

namespace Reuzze\ReuzzeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Roles
 *
 * @ORM\Table(name="roles")
 * @ORM\Entity
 */
class Roles
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="role_id", type="boolean")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $roleId;

    /**
     * @var string
     *
     * @ORM\Column(name="role_name", type="string", length=45, nullable=false)
     */
    private $roleName;

    /**
     * @var string
     *
     * @ORM\Column(name="role_description", type="string", length=255, nullable=true)
     */
    private $roleDescription;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="role_created", type="datetime", nullable=false)
     */
    private $roleCreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="role_modified", type="datetime", nullable=true)
     */
    private $roleModified;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="role_deleted", type="datetime", nullable=true)
     */
    private $roleDeleted;



    /**
     * Get roleId
     *
     * @return boolean 
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * Set roleName
     *
     * @param string $roleName
     * @return Roles
     */
    public function setRoleName($roleName)
    {
        $this->roleName = $roleName;

        return $this;
    }

    /**
     * Get roleName
     *
     * @return string 
     */
    public function getRoleName()
    {
        return $this->roleName;
    }

    /**
     * Set roleDescription
     *
     * @param string $roleDescription
     * @return Roles
     */
    public function setRoleDescription($roleDescription)
    {
        $this->roleDescription = $roleDescription;

        return $this;
    }

    /**
     * Get roleDescription
     *
     * @return string 
     */
    public function getRoleDescription()
    {
        return $this->roleDescription;
    }

    /**
     * Set roleCreated
     *
     * @param \DateTime $roleCreated
     * @return Roles
     */
    public function setRoleCreated($roleCreated)
    {
        $this->roleCreated = $roleCreated;

        return $this;
    }

    /**
     * Get roleCreated
     *
     * @return \DateTime 
     */
    public function getRoleCreated()
    {
        return $this->roleCreated;
    }

    /**
     * Set roleModified
     *
     * @param \DateTime $roleModified
     * @return Roles
     */
    public function setRoleModified($roleModified)
    {
        $this->roleModified = $roleModified;

        return $this;
    }

    /**
     * Get roleModified
     *
     * @return \DateTime 
     */
    public function getRoleModified()
    {
        return $this->roleModified;
    }

    /**
     * Set roleDeleted
     *
     * @param \DateTime $roleDeleted
     * @return Roles
     */
    public function setRoleDeleted($roleDeleted)
    {
        $this->roleDeleted = $roleDeleted;

        return $this;
    }

    /**
     * Get roleDeleted
     *
     * @return \DateTime 
     */
    public function getRoleDeleted()
    {
        return $this->roleDeleted;
    }
}
