<?php

namespace Softlogo\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Site extends Dictionary{

	/**
	 * @ORM\OneToMany(targetEntity="Page", mappedBy="site")
	 * @ORM\OrderBy({"itemorder" = "ASC"})
     */
    private $pages;

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
}
