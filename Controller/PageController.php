<?php

namespace Softlogo\CMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
	public function getRepository()
	{
		$em = $this->getDoctrine()->getManager();
		return $em->getRepository('SoftlogoCMSBundle:Page');
	}
	public function showAction($anchor="home")
	{
		$conf=$this->get('cms_conf');

		$menu = $this->getRepository()->findBy(array('isMenu'=>true), array('itemorder' => 'ASC'));
		$page = $this->getRepository()->findOneByAnchor($anchor);

		if (!$page) {
			throw $this->createNotFoundException('Unable to find Section entity.');
		}


		$view=$conf->getPageView($page->getType());
		//$view=$conf->getPageView('home');

		if ( $this->get('templating')->exists("SoftlogoCMSBundle:Page:$view"))
		{
			$viewpath="SoftlogoCMSBundle:Page:$view";
		}else $viewpath="SoftlogoCMSBundle:Page:page.html.twig";
		return $this->render($viewpath, array(
			'page'      => $page,
			'title'      => $page->getTitle(),
			'menu'      => $menu,
		));
	}
}
