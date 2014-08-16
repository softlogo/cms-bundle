<?php

namespace Softlogo\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Softlogo\CMSBundle\Entity\Section;

/**
 * @ORM\Entity
 * @ORM\Table(name="page")
 * @ORM\Entity(repositoryClass="Softlogo\CMSBundle\Repository\PageRepository")
 */
class Page extends AbstractSection
{

	/**
	 * @var \Site
	 *
	 * @ORM\ManyToOne(targetEntity="Site")
	 */
	private $site;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="is_menu", type="boolean", nullable=true)
	 */
	private $isMenu;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="is_active", type="boolean", nullable=true)
	 */
	private $isActive;

	/**
	* @ORM\Column(type="decimal", precision=1, scale=1, options={"default":0.5})
	*/
	private $priority;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="description", type="string", length=255, nullable=true)
	 */
	private $description;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="keywords", type="string", length=255, nullable=true)
	 */
	private $keywords;


	/**
	 * @ORM\OneToMany(targetEntity="PageSection", mappedBy="page", cascade="persist", orphanRemoval=true)
	 * @ORM\OrderBy({"itemorder" = "ASC"})
     */
    private $pageSections;

	/**
	 * @ORM\OneToMany(targetEntity="Article", mappedBy="page", cascade="persist", orphanRemoval=true)
	 * @ORM\OrderBy({"itemorder" = "ASC"})
     */
    private $articles;

	/**
	 * @ORM\OneToMany(targetEntity="Page", mappedBy="page", cascade="persist", orphanRemoval=true)
	 * @ORM\OrderBy({"itemorder" = "ASC"})
     */
    private $pages;

    /**
     * Constructor
     */
    public function __construct()
    {
		//parent:__construct();
        $this->pageSections = new \Doctrine\Common\Collections\ArrayCollection();
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set isMenu
     *
     * @param boolean $isMenu
     * @return Page
     */
    public function setIsMenu($isMenu)
    {
        $this->isMenu = $isMenu;

        return $this;
    }

    /**
     * Get isMenu
     *
     * @return boolean 
     */
    public function getIsMenu()
    {
        return $this->isMenu;
    }
    
    /**
     * Add pageSections
     *
     * @param \Softlogo\CMSBundle\Entity\PageSection $pageSections
     * @return Page
     */
    public function addPageSection(\Softlogo\CMSBundle\Entity\PageSection $pageSections)
    {
		$pageSections->setPage($this);
        $this->pageSections[] = $pageSections;

        return $this;
    }

    /**
     * Remove pageSections
     *
     * @param \Softlogo\CMSBundle\Entity\PageSection $pageSections
     */
    public function removePageSection(\Softlogo\CMSBundle\Entity\PageSection $pageSections)
    {
        $this->pageSections->removeElement($pageSections);
    }

    /**
     * Get pageSections
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPageSections()
    {

        return $this->pageSections;
    }

    /**
     * Add articles
     *
     * @param \Softlogo\CMSBundle\Entity\Article $articles
     * @return Page
     */
    public function addArticle(\Softlogo\CMSBundle\Entity\Article $articles)
    {
		$articles->setPage($this);
        $this->articles[] = $articles;

        return $this;
    }

    /**
     * Remove articles
     *
     * @param \Softlogo\CMSBundle\Entity\Article $articles
     */
    public function removeArticle(\Softlogo\CMSBundle\Entity\Article $articles)
    {
        $this->articles->removeElement($articles);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticles()
    {
        return $this->articles;
    }

	public function getFirstArticle(){
		return $this->getArticles()->first();
	}
	public function getLastArticles(){
		$this->getArticles()->removeElement($this->getArticles()->first());
		return $this->getArticles();
	}

    /**
     * Set site
     *
     * @param \Softlogo\CMSBundle\Entity\Site $site
     * @return Page
     */
    public function setSite(\Softlogo\CMSBundle\Entity\Site $site = null)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return \Softlogo\CMSBundle\Entity\Site 
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Add pages
     *
     * @param \Softlogo\CMSBundle\Entity\Page $pages
     * @return Page
     */
    public function addPage(\Softlogo\CMSBundle\Entity\Page $pages)
    {
		$pages->setPage($this);
        $this->pages[] = $pages;

        return $this;
    }

    /**
     * Remove pages
     *
     * @param \Softlogo\CMSBundle\Entity\Page $pages
     */
    public function removePage(\Softlogo\CMSBundle\Entity\Page $pages)
    {
        $this->pages->removeElement($pages);
    }

    /**
     * Get pages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPages()
    {
        return $this->pages;
    }


    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Page
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set priority
     *
     * @param string $priority
     * @return Page
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return string 
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Page
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set keywords
     *
     * @param string $keywords
     * @return Page
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * Get keywords
     *
     * @return string 
     */
    public function getKeywords()
    {
        return $this->keywords;
    }
}
