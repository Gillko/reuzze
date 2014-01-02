<?php

namespace Reuzze\ReuzzeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Users
 *
 * @ORM\Table(name="users", uniqueConstraints={@ORM\UniqueConstraint(name="username_UNIQUE", columns={"username"}), @ORM\UniqueConstraint(name="user_email_UNIQUE", columns={"user_email"})}, indexes={@ORM\Index(name="fk_users_persons1", columns={"person_id"}), @ORM\Index(name="fk_users_roles1_idx", columns={"role_id"})})
 * @ORM\Entity
 */
class Users implements UserInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $user_id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=45, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=60, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=30, nullable=false)
     */
    private $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="user_email", type="string", length=255, nullable=false)
     */
    private $userEmail;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_rating", type="integer", nullable=false)
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
    protected $person;

    /**
     * @var \Reuzze\ReuzzeBundle\Entity\Roles
     *
     * @ORM\ManyToOne(targetEntity="Reuzze\ReuzzeBundle\Entity\Roles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role_id", referencedColumnName="role_id")
     * })
     */
    protected $role;

    private $plainPassword;

    public function __construct(){
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
    }

    /**
     * Set user_id
     *
     * @param integer $user_id
     * @return Users
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get user_id
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Users
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return Users
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
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
     * @param integer $userRating
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
     * @return integer
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
     * Set role
     *
     * @param \Reuzze\ReuzzeBundle\Entity\Roles $role
     * @return Users
     */
    public function setRoles(\Reuzze\ReuzzeBundle\Entity\Roles $role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return \Reuzze\ReuzzeBundle\Entity\Roles
     */
    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function eraseCredentials(){
        $this->setPlainPassword(null);
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }
}
