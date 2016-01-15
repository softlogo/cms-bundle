<?php

namespace Softlogo\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SectionSection
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class SectionSection
{
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="itemorder", type="integer")
	 */
	private $itemorder;

	/**
	 *@ORM\ManyToOne(targetEntity="Section") 
	 */
	private $parent;

	/**
	 *@ORM\ManyToOne(targetEntity="Section") 
	 */
	private $child;


	/**
	 * Get id
	 *
	 * @return integer 
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set itemorder
	 *
	 * @param integer $itemorder
	 * @return SectionSection
	 */
	public function setItemorder($itemorder)
	{
		$this->itemorder = $itemorder;

		return $this;
	}

	/**
	 * Get itemorder
	 *
	 * @return integer 
	 */
	public function getItemorder()
	{
		return $this->itemorder;
	}

    /**
     * Set parent
     *
     * @param \Softlogo\CMSBundle\Entity\Section $parent
     * @return SectionSection
     */
    public function setParent(\Softlogo\CMSBundle\Entity\Section $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Softlogo\CMSBundle\Entity\Section 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set child
     *
     * @param \Softlogo\CMSBundle\Entity\Section $child
     * @return SectionSection
     */
    public function setChild(\Softlogo\CMSBundle\Entity\Section $child = null)
    {
        $this->child = $child;

        return $this;
    }

    /**
     * Get child
     *
     * @return \Softlogo\CMSBundle\Entity\Section 
     */
    public function getChild()
    {
        return $this->child;
    }
}
