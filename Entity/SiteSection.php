<?php

namespace Softlogo\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SiteSection
 *
 * @ORM\Table(name="site_section")
 * @ORM\Entity(repositoryClass="Softlogo\CMSBundle\Repository\SiteSectionRepository")
 */
class SiteSection
{
	public function __toString()
	{
		return $this->getSection() ? $this->getSection()->__toString() : "";
	}
    /**
     * @ORM\PrePersist
     */
    public function UpdateTimestamps()
    {
        $this->setCreatedAt(new \DateTime("now"));
    }  


	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var \Site
	 *
	 * @ORM\ManyToOne(targetEntity="Site")
	 */

	private $site;

	/**
	 *@ORM\ManyToOne(targetEntity="Section") 
	 */
	private $section;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="created_at", type="datetime", nullable=true)
	 */
	private $createdAt;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="number", type="integer", nullable=true)
	 */
	private $number;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="class", type="string", nullable=true)
	 */
	private $class;

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
	 * Set site
	 *
	 * @param integer $site
	 * @return SiteSection
	 */
	public function setSite($site)
	{
		$this->site = $site;

		return $this;
	}

	/**
	 * Get site
	 *
	 * @return integer 
	 */
	public function getSite()
	{
		return $this->site;
	}

	/**
	 * Set section
	 *
	 * @param integer $section
	 * @return SiteSection
	 */
	public function setSection($section)
	{
		$this->section = $section;

		return $this;
	}

	/**
	 * Get section
	 *
	 * @return integer 
	 */
	public function getSection()
	{
		return $this->section;
	}

	/**
	 * Set createdAt
	 *
	 * @param \DateTime $createdAt
	 * @return SiteSection
	 */
	public function setCreatedAt($createdAt)
	{
		$this->createdAt = $createdAt;

		return $this;
	}

	/**
	 * Get createdAt
	 *
	 * @return \DateTime 
	 */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	/**
	 * Set number
	 *
	 * @param integer $number
	 * @return SiteSection
	 */
	public function setNumber($number)
	{
		$this->number = $number;

		return $this;
	}

	/**
	 * Get number
	 *
	 * @return integer 
	 */
	public function getNumber()
	{
		return $this->number;
	}


    /**
     * Set class
     *
     * @param string $class
     * @return SiteSection
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class
     *
     * @return string 
     */
    public function getClass()
    {
        return $this->class;
    }

}
