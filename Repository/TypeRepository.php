<?php

namespace Softlogo\CMSBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * TypeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TypeRepository extends EntityRepository
{
	public function findAll()
	{
		    return $this->findBy(array(), array('name'=>'asc'));  
	}
}
