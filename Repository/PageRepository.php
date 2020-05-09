<?php

namespace Softlogo\CMSBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * PageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PageRepository extends EntityRepository
{
	public function findBySiteName($site, $language){
		$qb = $this->createQueryBuilder('p')
			->join('p.sites', 's');
		$qb->add('where', $qb->expr()->in('s.name', ':name'))
            ->setParameter('name', $site);
		$qb->andWhere('p.isMenu= true');
		$qb->andWhere('p.language= :language')
			->setParameter('language', $language);
		$qb->orderBy('p.itemorder', 'ASC');
		$query=$qb->getQuery();
		return $query->getResult();
	}
	public function findOnePage($anchor,$site){
		$qb = $this->createQueryBuilder('p')
			->join('p.sites', 's');
		$qb->add('where', $qb->expr()->in('s.name', ':name'))
			->setParameter('name', $site);
		$qb->andWhere('p.anchor= :anchor')
			->setParameter('anchor', $anchor);
		$query=$qb->getQuery();
		return $query->getOneOrNullResult();
	}

}
