<?php

namespace Softlogo\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PageSection
 *
 * @ORM\Table(name="page_section")
 * @ORM\Entity(repositoryClass="Softlogo\CMSBundle\Repository\PageSectionRepository")
 */
class PageSection
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
     * @ORM\PostPersist
     */
	public function updatePostPersist(){
		foreach($this->pageSections as $ps){
			/*
			 *if($ps->getType()){
			 *    $ps->getSection()->setType($ps->getType());
			 *}
			 */
			/*
			 *if($ps->getTitle()){
			 *    $ps->getSection()->setTitle($ps->getTitle());
			 *}
			 */
		}
	
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
	 * @var \Page
	 *
	 * @ORM\ManyToOne(targetEntity="Page")
	 */

	private $page;

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
	 * @ORM\Column(name="itemorder", type="integer", nullable=true)
	 */
	private $itemorder;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="wrapper", type="string", nullable=true)
	 */

	private $wrapper;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="offset", type="string", nullable=true)
	 */

	private $offset;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="anchor", type="string", nullable=true)
	 */
	private $anchor;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="class", type="string", nullable=true)
	 */
	private $class;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="type", type="string", length=255, nullable=true)
	 */
	private $type;

	/**
	 *@ORM\Column(type="string", nullable=true)
	 */
	private $title;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="block_type", type="string", length=255, nullable=true)
	 */
	private $blockType;


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
	 * Set page
	 *
	 * @param integer $page
	 * @return PageSection
	 */
	public function setPage($page)
	{
		$this->page = $page;

		return $this;
	}

	/**
	 * Get page
	 *
	 * @return integer 
	 */
	public function getPage()
	{
		return $this->page;
	}

	/**
	 * Set section
	 *
	 * @param integer $section
	 * @return PageSection
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
	 * @return PageSection
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
	 * Set itemorder
	 *
	 * @param integer $itemorder
	 * @return PageSection
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
     * Set title
     *
     * @param string $title
     * @return PageSection
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set wrapper
     *
     * @param string $wrapper
     * @return PageSection
     */
    public function setWrapper($wrapper)
    {
        $this->wrapper = $wrapper;

        return $this;
    }

    /**
     * Get wrapper
     *
     * @return string 
     */
    public function getWrapper()
    {
        return str_replace('_','-',$this->wrapper);
    }

    /**
     * Set anchor
     *
     * @param string $anchor
     * @return PageSection
     */
    public function setAnchor($anchor)
    {
        $this->anchor = $anchor;

        return $this;
    }

    /**
     * Get anchor
     *
     * @return string 
     */
    public function getAnchor()
    {
        return $this->anchor;
    }

    /**
     * Set offset
     *
     * @return string
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * Get offset
     *
     * @return string 
     */
    public function getOffset()
    {
        return str_replace('_','-',$this->offset);
    }

    /**
     * Set class
     *
     * @param string $class
     * @return PageSection
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

    /**
     * Set type
     *
     * @param string $type
     * @return PageSection
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set blockType
     *
     * @param string $blockType
     * @return PageSection
     */
    public function setBlockType($blockType)
    {
        $this->blockType = $blockType;

        return $this;
    }

    /**
     * Get blockType
     *
     * @return string 
     */
    public function getBlockType()
    {
        return $this->blockType;
    }
}
