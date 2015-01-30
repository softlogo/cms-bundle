<?php

namespace Softlogo\CMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Softlogo\CMSBundle\Entity\Section;
use Softlogo\CMSBundle\Util\SectionCollectionPager;

class SectionController extends Controller
{
	public function showAction($id)
	{
		$em = $this->getDoctrine()->getManager();

		$entity = $em->getRepository('SoftlogoCMSBundle:Section')->find($id);

		if (!$entity) {
			throw $this->createNotFoundException('Nie ma takiej sekcji');
		}
		return $this->render("SoftlogoCMSBundle:Section:show.html.twig", array(
			'section'=>$entity
		));    }
	public function pagingAction($id, $pageNumber=1)
	{
		$em = $this->getDoctrine()->getManager();

		$entity = $em->getRepository('SoftlogoCMSBundle:Section')->find($id);
		$pager=new SectionCollectionPager(3);
		$pager->setSection($entity);
		$page=$pager->getSectionsPage($pageNumber);

		if (!$entity) {
			throw $this->createNotFoundException('Nie ma takiej sekcji');
		}
		return $this->render("SoftlogoCMSBundle:Section:show.html.twig", array(
			'section'=>$page
		));    }

}
