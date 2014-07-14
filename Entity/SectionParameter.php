<?php

namespace Softlogo\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SectionParameter
 *
 * @ORM\Table(name="section_parameter")
 * @ORM\Entity
 */
class SectionParameter
{
	public function __toString()
	{
		return $this->getValue() ? $this->getValue() : "";
	}
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id", type="integer", nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $id;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="itemorder", type="integer", nullable=true)
	 */
	private $itemorder;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="value", type="string", nullable=true)
	 */
	private $value;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="created_at", type="datetime", nullable=true)
	 */
	private $createdAt;

	/**
	 * @var \Parameter
	 *
	 * @ORM\ManyToOne(targetEntity="Parameter")
	 */
	private $parameter;

	/**
	 * @var \Section
	 *
	 * @ORM\ManyToOne(targetEntity="Section")
	 */
	private $section;

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
	 * @return SectionParameter
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
	 * Set value
	 *
	 * @param string $value
	 * @return SectionParameter
	 */
	public function setValue($value)
	{
		$this->value = $value;

		return $this;
	}

	/**
	 * Get value
	 *
	 * @return string 
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * Set createdAt
	 *
	 * @param \DateTime $createdAt
	 * @return SectionParameter
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
	 * Set parameter
	 *
	 * @param \Softlogo\CMSBundle\Entity\Parameter $parameter
	 * @return SectionParameter
	 */
	public function setParameter(\Softlogo\CMSBundle\Entity\Parameter $parameter = null)
	{
		$this->parameter = $parameter;

		return $this;
	}

	/**
	 * Get parameter
	 *
	 * @return \Softlogo\CMSBundle\Entity\Parameter 
	 */
	public function getParameter()
	{
		return $this->parameter;
	}

	/**
	 * Set section
	 *
	 * @param \Softlogo\CMSBundle\Entity\Section $section
	 * @return SectionParameter
	 */
	public function setSection(\Softlogo\CMSBundle\Entity\Section $section = null)
	{
		$this->section = $section;

		return $this;
	}

	/**
	 * Get section
	 *
	 * @return \Softlogo\CMSBundle\Entity\Section 
	 */
	public function getSection()
	{
		return $this->section;
	}
}
