<?php

namespace Reuzze\ReuzzeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Persons
 *
 * @ORM\Table(name="persons", indexes={@ORM\Index(name="fk_persons_addresses1_idx", columns={"address_id"})})
 * @ORM\Entity
 */
class Persons
{
    /**
     * @var integer
     *
     * @ORM\Column(name="person_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $personId;

    /**
     * @var string
     *
     * @ORM\Column(name="person_firstname", type="string", length=45, nullable=false)
     */
    private $personFirstname;

    /**
     * @var string
     *
     * @ORM\Column(name="person_surname", type="string", length=255, nullable=false)
     */
    private $personSurname;

    /**
     * @var string
     *
     * @ORM\Column(name="person_profile", type="text", nullable=true)
     */
    private $personProfile;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="person_created", type="datetime", nullable=false)
     */
    private $personCreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="person_modified", type="datetime", nullable=true)
     */
    private $personModified;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="person_deleted", type="datetime", nullable=true)
     */
    private $personDeleted;

    /**
     * @var \Reuzze\ReuzzeBundle\Entity\Addresses
     *
     * @ORM\ManyToOne(targetEntity="Reuzze\ReuzzeBundle\Entity\Addresses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="address_id", referencedColumnName="address_id")
     * })
     */
    private $address;



    /**
     * Get personId
     *
     * @return integer 
     */
    public function getPersonId()
    {
        return $this->personId;
    }

    /**
     * Set personFirstname
     *
     * @param string $personFirstname
     * @return Persons
     */
    public function setPersonFirstname($personFirstname)
    {
        $this->personFirstname = $personFirstname;

        return $this;
    }

    /**
     * Get personFirstname
     *
     * @return string 
     */
    public function getPersonFirstname()
    {
        return $this->personFirstname;
    }

    /**
     * Set personSurname
     *
     * @param string $personSurname
     * @return Persons
     */
    public function setPersonSurname($personSurname)
    {
        $this->personSurname = $personSurname;

        return $this;
    }

    /**
     * Get personSurname
     *
     * @return string 
     */
    public function getPersonSurname()
    {
        return $this->personSurname;
    }

    /**
     * Set personProfile
     *
     * @param string $personProfile
     * @return Persons
     */
    public function setPersonProfile($personProfile)
    {
        $this->personProfile = $personProfile;

        return $this;
    }

    /**
     * Get personProfile
     *
     * @return string 
     */
    public function getPersonProfile()
    {
        return $this->personProfile;
    }

    /**
     * Set personCreated
     *
     * @param \DateTime $personCreated
     * @return Persons
     */
    public function setPersonCreated($personCreated)
    {
        $this->personCreated = $personCreated;

        return $this;
    }

    /**
     * Get personCreated
     *
     * @return \DateTime 
     */
    public function getPersonCreated()
    {
        return $this->personCreated;
    }

    /**
     * Set personModified
     *
     * @param \DateTime $personModified
     * @return Persons
     */
    public function setPersonModified($personModified)
    {
        $this->personModified = $personModified;

        return $this;
    }

    /**
     * Get personModified
     *
     * @return \DateTime 
     */
    public function getPersonModified()
    {
        return $this->personModified;
    }

    /**
     * Set personDeleted
     *
     * @param \DateTime $personDeleted
     * @return Persons
     */
    public function setPersonDeleted($personDeleted)
    {
        $this->personDeleted = $personDeleted;

        return $this;
    }

    /**
     * Get personDeleted
     *
     * @return \DateTime 
     */
    public function getPersonDeleted()
    {
        return $this->personDeleted;
    }

    /**
     * Set address
     *
     * @param \Reuzze\ReuzzeBundle\Entity\Addresses $address
     * @return Persons
     */
    public function setAddress(\Reuzze\ReuzzeBundle\Entity\Addresses $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return \Reuzze\ReuzzeBundle\Entity\Addresses 
     */
    public function getAddress()
    {
        return $this->address;
    }
}
