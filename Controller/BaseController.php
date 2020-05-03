<?php

namespace Softlogo\CMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Softlogo\CMSBundle\Entity\Contact;
use Symfony\Component\HttpFoundation\Request;
use Softlogo\CMSBundle\Services\EntityManagementGuesser;

class BaseController extends Controller
{
	public function getRepository()
	{
		$em = $this->getDoctrine()->getManager();
		return $em->getRepository('SoftlogoCMSBundle:Page');
	}

	public function getPageRepository()
	{
		$em = $this->getDoctrine()->getManager();
		return $em->getRepository('SoftlogoCMSBundle:Page');
	}

	public function getSiteRepository()
	{
		$em = $this->getDoctrine()->getManager();
		return $em->getRepository('SoftlogoCMSBundle:Site');
	}

	public function getLanguageRepository()
	{
		$em = $this->getDoctrine()->getManager();
		return $em->getRepository('SoftlogoCMSBundle:Language');
	}

	public function getEm(){
		return $this->getDoctrine()->getManager();
	}

	public function getView($bundleShort, $view){
		$this->setPath();
		$cv=$this->get('softlogo_custom_view');
		return $cv->getView($bundleShort, $view);
	}
	public function setPath(){
		$em = $this->getDoctrine()->getManager();
		$host=$this->getHost();
		$site=$em->getRepository("SoftlogoCMSBundle:Site")->findOneByHost($host);
		$this->get('twig.loader')->addPath($this->get('kernel')->getRootDir() . '/../sites/'.$site->getName().'/views', 'home');
	}
	public function getSitePath($view){
        $site= $this->getSiteRepository()->findOneByHost($this->getHost());
		//echo $this->get('kernel')->getRootDir().'/../sites/'.$site->getName().'/views/'.$view;
		$path=realpath($this->get('kernel')->getRootDir().'/../sites/'.$site->getName().'/views/'.$view);
		$this->addHomePath();
		return $path;
	}
	public function addHomePath(){
        $site= $this->getSiteRepository()->findOneByHost($this->getHost());
        $this->get('twig.loader')->addPath($this->get('kernel')->getRootDir() . '/../sites/'.$site->getName().'/views', 'home');
	}


}
