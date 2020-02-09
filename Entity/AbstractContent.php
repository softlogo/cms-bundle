<?php

namespace Softlogo\CMSBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class AbstractContent
{
	public function getContent($locale=''){
		foreach($this->getContents() as $content){
			if($content->getLanguage()==$locale){
				return $content;
			}
		}
		return null;
	}

}
