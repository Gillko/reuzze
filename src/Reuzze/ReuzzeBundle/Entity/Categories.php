<?php

namespace Reuzze\ReuzzeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categories
 *
 * @ORM\Table(name="categories", indexes={@ORM\Index(name="fk_categories_categories1_idx", columns={"category_parentid"})})
 * @ORM\Entity
 */
class Categories
{
    /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $categoryId;

    /**
     * @var string
     *
     * @ORM\Column(name="category_name", type="string", length=45, nullable=false)
     */
    private $categoryName;

    /**
     * @var string
     *
     * @ORM\Column(name="category_description", type="string", length=255, nullable=false)
     */
    private $categoryDescription;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="category_created", type="datetime", nullable=false)
     */
    private $categoryCreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="category_modified", type="datetime", nullable=true)
     */
    private $categoryModified;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="category_deleted", type="datetime", nullable=true)
     */
    private $categoryDeleted;

    /**
     * @var \Reuzze\ReuzzeBundle\Entity\Categories
     *
     * @ORM\ManyToOne(targetEntity="Reuzze\ReuzzeBundle\Entity\Categories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_parentid", referencedColumnName="category_id")
     * })
     */
    private $categoryParentid;



    /**
     * Get categoryId
     *
     * @return boolean 
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set categoryName
     *
     * @param string $categoryName
     * @return Categories
     */
    public function setCategoryName($categoryName)
    {
        $this->categoryName = $categoryName;

        return $this;
    }

    /**
     * Get categoryName
     *
     * @return string 
     */
    public function getCategoryName()
    {
        return $this->categoryName;
    }

    /**
     * Set categoryDescription
     *
     * @param string $categoryDescription
     * @return Categories
     */
    public function setCategoryDescription($categoryDescription)
    {
        $this->categoryDescription = $categoryDescription;

        return $this;
    }

    /**
     * Get categoryDescription
     *
     * @return string 
     */
    public function getCategoryDescription()
    {
        return $this->categoryDescription;
    }

    /**
     * Set categoryCreated
     *
     * @param \DateTime $categoryCreated
     * @return Categories
     */
    public function setCategoryCreated($categoryCreated)
    {
        $this->categoryCreated = $categoryCreated;

        return $this;
    }

    /**
     * Get categoryCreated
     *
     * @return \DateTime 
     */
    public function getCategoryCreated()
    {
        return $this->categoryCreated;
    }

    /**
     * Set categoryModified
     *
     * @param \DateTime $categoryModified
     * @return Categories
     */
    public function setCategoryModified($categoryModified)
    {
        $this->categoryModified = $categoryModified;

        return $this;
    }

    /**
     * Get categoryModified
     *
     * @return \DateTime 
     */
    public function getCategoryModified()
    {
        return $this->categoryModified;
    }

    /**
     * Set categoryDeleted
     *
     * @param \DateTime $categoryDeleted
     * @return Categories
     */
    public function setCategoryDeleted($categoryDeleted)
    {
        $this->categoryDeleted = $categoryDeleted;

        return $this;
    }

    /**
     * Get categoryDeleted
     *
     * @return \DateTime 
     */
    public function getCategoryDeleted()
    {
        return $this->categoryDeleted;
    }

    /**
     * Set categoryParentid
     *
     * @param \Reuzze\ReuzzeBundle\Entity\Categories $categoryParentid
     * @return Categories
     */
    public function setCategoryParentid(\Reuzze\ReuzzeBundle\Entity\Categories $categoryParentid = null)
    {
        $this->categoryParentid = $categoryParentid;

        return $this;
    }

    /**
     * Get categoryParentid
     *
     * @return \Reuzze\ReuzzeBundle\Entity\Categories 
     */
    public function getCategoryParentid()
    {
        return $this->categoryParentid;
    }
}
