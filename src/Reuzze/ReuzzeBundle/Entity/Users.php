<?php

namespace Reuzze\ReuzzeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users", uniqueConstraints={@ORM\UniqueConstraint(name="user_username_UNIQUE", columns={"user_username"}), @ORM\UniqueConstraint(name="user_email_UNIQUE", columns={"user_email"})}, indexes={@ORM\Index(name="fk_users_persons1", columns={"person_id"}), @ORM\Index(name="fk_users_languages1_idx", columns={"language_id"})})
 * @ORM\Entity
 */
class Users
{
    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="user_username", type="string", length=45, nullable=false)
     */
    private $userUsername;

    /**
     * @var string
     *
     * @ORM\Column(name="user_email", type="string", length=255, nullable=false)
     */
    private $userEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="user_rating", type="decimal", precision=2, scale=0, nullable=false)
     */
    private $userRating;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_created", type="datetime", nullable=false)
     */
    private $userCreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_modified", type="datetime", nullable=true)
     */
    private $userModified;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_deleted", type="datetime", nullable=true)
     */
    private $userDeleted;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_lastlogin", type="datetime", nullable=true)
     */
    private $userLastlogin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_locked", type="datetime", nullable=true)
     */
    private $userLocked;

    /**
     * @var \Reuzze\ReuzzeBundle\Entity\Persons
     *
     * @ORM\OneToOne(targetEntity="Reuzze\ReuzzeBundle\Entity\Persons")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="person_id", referencedColumnName="person_id", unique=true)
     * })
     */
    private $person;

    /**
     * @var \Reuzze\ReuzzeBundle\Entity\Languages
     *
     * @ORM\OneToOne(targetEntity="Reuzze\ReuzzeBundle\Entity\Languages")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="language_id", referencedColumnName="language_id", unique=true)
     * })
     */
    private $language;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Reuzze\ReuzzeBundle\Entity\Roles", inversedBy="user")
     * @ORM\JoinTable(name="users_has_roles",
     *   joinColumns={
     *     @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="role_id", referencedColumnName="role_id")
     *   }
     * )
     */
    private $role;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->role = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set userId
     *
     * @param integer $userId
     * @return Users
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set userUsername
     *
     * @param string $userUsername
     * @return Users
     */
    public function setUserUsername($userUsername)
    {
        $this->userUsername = $userUsername;

        return $this;
    }

    /**
     * Get userUsername
     *
     * @return string 
     */
    public function getUserUsername()
    {
        return $this->userUsername;
    }

    /**
     * Set userEmail
     *
     * @param string $userEmail
     * @return Users
     */
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;

        return $this;
    }

    /**
     * Get userEmail
     *
     * @return string 
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * Set userRating
     *
     * @param string $userRating
     * @return Users
     */
    public function setUserRating($userRating)
    {
        $this->userRating = $userRating;

        return $this;
    }

    /**
     * Get userRating
     *
     * @return string 
     */
    public function getUserRating()
    {
        return $this->userRating;
    }

    /**
     * Set userCreated
     *
     * @param \DateTime $userCreated
     * @return Users
     */
    public function setUserCreated($userCreated)
    {
        $this->userCreated = $userCreated;

        return $this;
    }

    /**
     * Get userCreated
     *
     * @return \DateTime 
     */
    public function getUserCreated()
    {
        return $this->userCreated;
    }

    /**
     * Set userModified
     *
     * @param \DateTime $userModified
     * @return Users
     */
    public function setUserModified($userModified)
    {
        $this->userModified = $userModified;

        return $this;
    }

    /**
     * Get userModified
     *
     * @return \DateTime 
     */
    public function getUserModified()
    {
        return $this->userModified;
    }

    /**
     * Set userDeleted
     *
     * @param \DateTime $userDeleted
     * @return Users
     */
    public function setUserDeleted($userDeleted)
    {
        $this->userDeleted = $userDeleted;

        return $this;
    }

    /**
     * Get userDeleted
     *
     * @return \DateTime 
     */
    public function getUserDeleted()
    {
        return $this->userDeleted;
    }

    /**
     * Set userLastlogin
     *
     * @param \DateTime $userLastlogin
     * @return Users
     */
    public function setUserLastlogin($userLastlogin)
    {
        $this->userLastlogin = $userLastlogin;

        return $this;
    }

    /**
     * Get userLastlogin
     *
     * @return \DateTime 
     */
    public function getUserLastlogin()
    {
        return $this->userLastlogin;
    }

    /**
     * Set userLocked
     *
     * @param \DateTime $userLocked
     * @return Users
     */
    public function setUserLocked($userLocked)
    {
        $this->userLocked = $userLocked;

        return $this;
    }

    /**
     * Get userLocked
     *
     * @return \DateTime 
     */
    public function getUserLocked()
    {
        return $this->userLocked;
    }

    /**
     * Set person
     *
     * @param \Reuzze\ReuzzeBundle\Entity\Persons $person
     * @return Users
     */
    public function setPerson(\Reuzze\ReuzzeBundle\Entity\Persons $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \Reuzze\ReuzzeBundle\Entity\Persons 
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Set language
     *
     * @param \Reuzze\ReuzzeBundle\Entity\Languages $language
     * @return Users
     */
    public function setLanguage(\Reuzze\ReuzzeBundle\Entity\Languages $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \Reuzze\ReuzzeBundle\Entity\Languages 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Add role
     *
     * @param \Reuzze\ReuzzeBundle\Entity\Roles $role
     * @return Users
     */
    public function addRole(\Reuzze\ReuzzeBundle\Entity\Roles $role)
    {
        $this->role[] = $role;

        return $this;
    }

    /**
     * Remove role
     *
     * @param \Reuzze\ReuzzeBundle\Entity\Roles $role
     */
    public function removeRole(\Reuzze\ReuzzeBundle\Entity\Roles $role)
    {
        $this->role->removeElement($role);
    }

    /**
     * Get role
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRole()
    {
        return $this->role;
    }
}
