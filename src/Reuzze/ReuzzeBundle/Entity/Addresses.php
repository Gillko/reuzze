<?php

namespace Reuzze\ReuzzeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Addresses
 *
 * @ORM\Table(name="addresses", indexes={@ORM\Index(name="fk_addresses_regions1_idx", columns={"region_id"})})
 * @ORM\Entity
 */
class Addresses
{
    /**
     * @var integer
     *
     * @ORM\Column(name="address_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $addressId;

    /**
     * @var string
     *
     * @ORM\Column(name="address_street", type="string", length=45, nullable=false)
     */
    protected $addressStreet;

    /**
     * @var string
     *
     * @ORM\Column(name="address_city", type="string", length=45, nullable=false)
     */
    protected $addressCity;

    /**
     * @var string
     *
     * @ORM\Column(name="address_lat", type="decimal", precision=18, scale=12, nullable=true)
     */
    protected $addressLat;

    /**
     * @var string
     *
     * @ORM\Column(name="address_lon", type="decimal", precision=18, scale=12, nullable=true)
     */
    protected $addressLon;

    /**
     * @var integer
     *
     * @ORM\Column(name="address_streetnr", type="integer", nullable=false)
     */
    protected $addressStreetnr;

    /**
     * @var \Reuzze\ReuzzeBundle\Entity\Regions
     *
     * @ORM\ManyToOne(targetEntity="Reuzze\ReuzzeBundle\Entity\Regions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="region_id", referencedColumnName="region_id")
     * })
     */
    protected $region;



    /**
     * Get addressId
     *
     * @return integer 
     */
    public function getAddressId()
    {
        return $this->addressId;
    }

    /**
     * Set addressStreet
     *
     * @param string $addressStreet
     * @return Addresses
     */
    public function setAddressStreet($addressStreet)
    {
        $this->addressStreet = $addressStreet;

        return $this;
    }

    /**
     * Get addressStreet
     *
     * @return string 
     */
    public function getAddressStreet()
    {
        return $this->addressStreet;
    }

    /**
     * Set addressCity
     *
     * @param string $addressCity
     * @return Addresses
     */
    public function setAddressCity($addressCity)
    {
        $this->addressCity = $addressCity;

        return $this;
    }

    /**
     * Get addressCity
     *
     * @return string 
     */
    public function getAddressCity()
    {
        return $this->addressCity;
    }

    /**
     * Set addressLat
     *
     * @param string $addressLat
     * @return Addresses
     */
    public function setAddressLat($addressLat)
    {
        $this->addressLat = $addressLat;

        return $this;
    }

    /**
     * Get addressLat
     *
     * @return string 
     */
    public function getAddressLat()
    {
        return $this->addressLat;
    }

    /**
     * Set addressLon
     *
     * @param string $addressLon
     * @return Addresses
     */
    public function setAddressLon($addressLon)
    {
        $this->addressLon = $addressLon;

        return $this;
    }

    /**
     * Get addressLon
     *
     * @return string 
     */
    public function getAddressLon()
    {
        return $this->addressLon;
    }

    /**
     * Set addressStreetnr
     *
     * @param integer $addressStreetnr
     * @return Addresses
     */
    public function setAddressStreetnr($addressStreetnr)
    {
        $this->addressStreetnr = $addressStreetnr;

        return $this;
    }

    /**
     * Get addressStreetnr
     *
     * @return integer 
     */
    public function getAddressStreetnr()
    {
        return $this->addressStreetnr;
    }

    /**
     * Set region
     *
     * @param \Reuzze\ReuzzeBundle\Entity\Regions $region
     * @return Addresses
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
}
