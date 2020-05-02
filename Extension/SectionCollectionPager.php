<?php
namespace Softlogo\CMSBundle\Extension;
use Doctrine\Common\Collections\ArrayCollection;
use Softlogo\CMSBundle\Entity\AbstractSection;
use Softlogo\CMSBundle\Entity\Section;

class SectionCollectionPager
{
	protected $section;
	protected $offset;

	public function __construct($offset=6){
		$this->offset=$offset;
	}
	public function setSection(Section $section){
		$this->section=$section;
	}

	protected function getPage($collection,$pageNumber, $offset){
		$c2= clone $collection;
		$c2->clear();
		$min=($pageNumber-1)*$offset;
		$max=$pageNumber*$offset-1;

		for($i=$min; $i<=$max; $i++){
			if($collection->containsKey($i)){
				$c2->add($collection->get($i));
			}

		}

		return $c2;
	
	}

	public function getSectionsPage($pageNumber){
		$collection= $this->getPage($this->section->getSectionSections(),$pageNumber, $this->offset);
		$this->section->clearSections();
		foreach ($collection as $col){
			$this->section->addSectionSection($col);
		}
		return $this->section;
	}


}
