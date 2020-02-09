<?php

namespace Softlogo\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Site extends Dictionary{

	/**
	 * @ORM\ManyToMany(targetEntity="Page", inversedBy="sites")
	 * @ORM\OrderBy({"itemorder" = "ASC"})
     */
    private $pages;

	/**
     * @var string
     *
     * @ORM\Column(name="host", type="string", length=255, nullable=false)
     */
	private $host;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pages = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add pages
     *
     * @param \Softlogo\CMSBundle\Entity\Page $pages
     * @return Site
     */
    public function addPage(\Softlogo\CMSBundle\Entity\Page $pages)
    {
		//$pages->addSite($this);
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
     * Set host
     *
     * @param string $host
     *
     * @return Site
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Get host
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }
}
