<?php

namespace Softlogo\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Softlogo\CMSBundle\Entity\AbstractSection;

/**

 * @ORM\Entity
 * @ORM\Table(name="section")
 */
class Section extends AbstractSection
{

	/**
	 * @var \SectionMedia
	 *
	 * @ORM\OneToMany(targetEntity="SectionMedia", mappedBy="section",cascade={"all"}, orphanRemoval=true)
	 * @ORM\OrderBy({"itemorder" = "ASC"})
	 */
	private $sectionMedias;

	/**
	 * @var \Section
	 *
	 * @ORM\OneToMany(targetEntity="Section", mappedBy="parent",cascade={"all"}, orphanRemoval=true)
	 * @ORM\OrderBy({"itemorder" = "ASC"})
	 */
	private $sections;

	/**
	 * @var \Article
	 *
	 * @ORM\OneToMany(targetEntity="Article", mappedBy="section" ,cascade={"all"}, orphanRemoval=true)
	 */
	private $articles;

	/**
	 * @ORM\OneToMany(targetEntity="SectionParameter", mappedBy="section", cascade="persist", orphanRemoval=true)
	 * @ORM\OrderBy({"itemorder" = "ASC"})
	 */
	private $sectionParameters;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->sections = new \Doctrine\Common\Collections\ArrayCollection();
		$this->articles = new \Doctrine\Common\Collections\ArrayCollection();
		$this->isPage=0;
		$this->isMainSection=1;
	}

	/**
	 * Add sections
	 *
	 * @param \Softlogo\CMSBundle\Entity\Section $sections
	 * @return Section
	 */
	public function addSection(\Softlogo\CMSBundle\Entity\Section $sections)
	{
		$sections->setParent($this);    
		$sections->setIsMainSection(false);
		$this->sections[] = $sections;

		return $this;
	}

	/**
	 * Remove sections
	 *
	 * @param \Softlogo\CMSBundle\Entity\Section $sections
	 */
	public function removeSection(\Softlogo\CMSBundle\Entity\Section $sections)
	{
		$this->sections->removeElement($sections);
	}

	/**
	 * Get sections
	 *
	 * @return \Doctrine\Common\Collections\Collection 
	 */
	public function getSections()
	{
		return $this->sections;
	}

	/**
	 * Add articles
	 *
	 * @param \Softlogo\CMSBundle\Entity\Article $articles
	 * @return Section
	 */
	public function addArticle(\Softlogo\CMSBundle\Entity\Article $articles)
	{
		$articles->setSection($this);    
		$this->articles[] = $articles;

		return $this;
	}

	public function addArticleCollection($articles)
	{
		$this->articles = $articles;

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
	public function getArticles($name='')
	{
		if($name!=''){
			foreach ($this->articles as $article){
				if($article->getType()->getName()==$name){
					$articles[]=$article;
				}	
			}
			return $articles;
		}
		else return $this->articles;
	}

	/**
	 * Add sectionMedias
	 *
	 * @param \Softlogo\CMSBundle\Entity\SectionMedia $sectionMedias
	 * @return Section
	 */
	public function addSectionMedia(\Softlogo\CMSBundle\Entity\SectionMedia $sectionMedias)
	{
		$sectionMedias->setSection($this);    
		$this->sectionMedias[] = $sectionMedias;

		return $this;
	}

	/**
	 * Remove sectionMedias
	 *
	 * @param \Softlogo\CMSBundle\Entity\SectionMedia $sectionMedias
	 */
	public function removeSectionMedia(\Softlogo\CMSBundle\Entity\SectionMedia $sectionMedias)
	{
		$this->sectionMedias->removeElement($sectionMedias);
	}

	/**
	 * Get sectionMedias
	 *
	 * @return \Doctrine\Common\Collections\Collection 
	 */
	public function getSectionMedias()
	{
		return $this->sectionMedias;
	}
	public function getFirstSectionMedia(){
		return $this->getSectionMedias()->first();
	}
	public function getLastSectionMedias(){
		$this->getSectionMedias()->removeElement($this->getSectionMedias()->first());
		return $this->getSectionMedias();
	}
	public function getFirstArticle(){
		return $this->getArticles()->first();
	}
	public function getLastArticles(){
		$this->getArticles()->removeElement($this->getArticles()->first());
		return $this->getArticles();
	}

	/**
	 * Add sectionParameters
	 *
	 * @param \Softlogo\CMSBundle\Entity\SectionParameter $sectionParameters
	 * @return Section
	 */
	public function addSectionParameter(\Softlogo\CMSBundle\Entity\SectionParameter $sectionParameters)
	{
		$sectionParameters->setSection($this);    
		$this->sectionParameters[] = $sectionParameters;

		return $this;
	}

	/**
	 * Remove sectionParameters
	 *
	 * @param \Softlogo\CMSBundle\Entity\SectionParameter $sectionParameters
	 */
	public function removeSectionParameter(\Softlogo\CMSBundle\Entity\SectionParameter $sectionParameters)
	{
		$this->sectionParameters->removeElement($sectionParameters);
	}

	/**
	 * Get sectionParameters
	 *
	 * @return \Doctrine\Common\Collections\Collection 
	 */
	public function getSectionParameters()
	{
		return $this->sectionParameters;
	}
	public function getSectionParameterByName($name)
	{
		$parameter=false;
		foreach ($this->getSectionParameters() as $sm){
			if ($sm->getParameter()->getName()==$name){
				$parameter= $sm->getValue();
			}
		}
		return $parameter;
	}


}
