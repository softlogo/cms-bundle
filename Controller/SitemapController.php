<?php

namespace Softlogo\CMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class SitemapController extends Controller
{
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$urls = array();
		$hostname = $this->getRequest()->getHost();

		// add some urls homepage
		$urls[] = array('loc' => $this->get('router')->generate('home'), 'changefreq' => 'weekly', 'priority' => '1.0');
		$urls[] = array('loc' => $this->get('router')->generate('cms_strony_internetowe'), 'changefreq' => 'weekly', 'priority' => '1.0');

		// pages
		foreach ($em->getRepository('SoftlogoCMSBundle:Page')->findAll() as $page) 
		{
			if($page->getIsActive()){
				if($page->getSite()=="main"){
					$urls[] = array('loc' => $this->get('router')->generate('cms_page', array('anchor' => $page->getAnchor())), 'priority' => $page->getPriority());
				}else{
					$urls[] = array('loc' => $this->get('router')->generate('cms_site_page', array('site' => $page->getSite(), 'anchor' => $page->getAnchor())), 'priority' => $page->getPriority());
				}
			}
		}

		return $this->render("SoftlogoCMSBundle:Sitemap:index.html.twig", array(
			'urls'      => $urls,
			'hostname' => $hostname
		));
	}

}
