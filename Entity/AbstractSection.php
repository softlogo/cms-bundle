<?php

namespace Softlogo\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Softlogo\CMSBundle\Entity\AbstractContent;

/**

 * @ORM\MappedSuperclass
 */
class AbstractSection extends AbstractContent
{
	public function __toString()
	{
		return $this->getTitle() ? $this->getTitle() : "";
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
	 * @var string
	 *
	 * @ORM\Column(name="name", type="string", length=255, nullable=true)
	 */
	private $name;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="title", type="string", length=255, nullable=true)
	 */
	private $title;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="subtitle", type="string", length=255, nullable=true)
	 */
	private $subtitle;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="type", type="string", length=255, nullable=true)
	 */
	private $type;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="anchor", type="string", length=255, nullable=true)
	 */
	private $anchor;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="href", type="string", length=255, nullable=true)
	 */
	private $href;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="itemorder", type="integer", nullable=true)
	 */
	private $itemorder;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="created_at", type="datetime", nullable=true)
	 */
	private $createdAt;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="updated_at", type="datetime", nullable=true)
	 */
	private $updatedAt;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="is_visible", type="boolean", nullable=true)
	 */
	private $isVisible;

	 /**
	 * @var boolean
	 * @ORM\Column(name="is_main_section", type="boolean", nullable=true, options={"default" = true})
	 */
	private $isMainSection;

	/**
	 * @var \Section
	 *
	 * @ORM\ManyToOne(targetEntity="Section")
	 * @ORM\JoinColumns({
	 *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
	 * })
	 */
	private $parent;

    /**
     * @var \Language
     *
     * @ORM\ManyToOne(targetEntity="Language")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     * })
     */
    private $language;


	/**
	 * @var \Page
	 *
	 * @ORM\ManyToOne(targetEntity="Page")
	 */
	private $page;


	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->isPage=0;
		$this->isMainSection=1;
	}

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
	 * Set title
	 *
	 * @param string $title
	 * @return Section
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

	public function getFullTitle()
	{
		return $this->title." ".$this->subtitle;
	}

	/**
	 * Set anchor
	 *
	 * @param string $anchor
	 * @return Section
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
	 * Set itemorder
	 *
	 * @param integer $itemorder
	 * @return Section
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
	 * Set createdAt
	 *
	 * @param \DateTime $createdAt
	 * @return Section
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
	 * Set updatedAt
	 *
	 * @param \DateTime $updatedAt
	 * @return Section
	 */
	public function setUpdatedAt($updatedAt)
	{
		$this->updatedAt = $updatedAt;

		return $this;
	}

	/**
	 * Get updatedAt
	 *
	 * @return \DateTime 
	 */
	public function getUpdatedAt()
	{
		return $this->updatedAt;
	}

	/**
	 * Set isVisible
	 *
	 * @param boolean $isVisible
	 * @return Section
	 */
	public function setIsVisible($isVisible)
	{
		$this->isVisible = $isVisible;

		return $this;
	}

	/**
	 * Get isVisible
	 *
	 * @return boolean 
	 */
	public function getIsVisible()
	{
		return $this->isVisible;
	}


	/**
	 * Set parent
	 *
	 * @param \Softlogo\CMSBundle\Entity\Section $parent
	 * @return Section
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
	 * Get href
	 *
	 * @return string 
	 */
	public function getHref()
	{
		return $this->href;
	}

    /**
     * @ORM\PrePersist
     */
    public function UpdateTimestamps()
    {
        $this->setCreatedAt(new \DateTime("now"));
    }  

    /**
     * Set href
     *
     * @param string $href
     * @return AbstractSection
     */
    public function setHref($href)
    {
        $this->href = $href;

        return $this;
    }

    /**
     * Set isMainSection
     *
     * @param boolean $isMainSection
     * @return AbstractSection
     */
    public function setIsMainSection($isMainSection)
    {
        $this->isMainSection = $isMainSection;

        return $this;
    }

    /**
     * Get isMainSection
     *
     * @return boolean 
     */
    public function getIsMainSection()
    {
        return $this->isMainSection;
    }


    /**
     * Set subtitle
     *
     * @param string $subtitle
     * @return AbstractSection
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Get subtitle
     *
     * @return string 
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set page
     *
     * @param \Softlogo\CMSBundle\Entity\Page $page
     * @return AbstractSection
     */
    public function setPage(\Softlogo\CMSBundle\Entity\Page $page = null)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return \Softlogo\CMSBundle\Entity\Page 
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set type
     *
     * @param array $type
     * @return AbstractSection
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return array 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return AbstractSection
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Set language
     *
     * @param \Softlogo\CMSBundle\Entity\Language $language
     * @return Article
     */
    public function setLanguage(\Softlogo\CMSBundle\Entity\Language $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \Softlogo\CMSBundle\Entity\Language 
     */
    public function getLanguage()
    {
        return $this->language;
    }

}
