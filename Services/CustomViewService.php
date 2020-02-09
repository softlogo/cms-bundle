<?php
namespace Softlogo\CMSBundle\Services; 

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Templating\EngineInterface;
use Softlogo\CMSBundle\Services\CMSConfiguration;
use Symfony\Component\Templating\Helper\Helper;

class CustomViewService{

	private $em;
	private $request;
	private $conf;
	private $rootDir;
	public function __construct($em,  $request_stack, $conf, $loader, $rootDir){
		$this->em=$em;
	    $this->request = $request_stack->getCurrentRequest();
		$this->conf=$conf;
		$this->loader=$loader;
		$this->rootDir=$rootDir;
		$this->setPath();
	}
	
	public function setPath(){
	
		/*
		 *$cstr=$this->request->attributes->get('_controller');
		 *$cTab=explode('\\',explode('::',$cstr)[0],4);
		 *$cClass=$cTab[0].'/'.$cTab[1].'/'.$cTab[2].'/'.$cTab[3];
		 *echo $cClass;
		 */
	}
	public function getSite(){
	
		$host=$this->request->getHost();
		$site=$this->em->getRepository("SoftlogoCMSBundle:Site")->findOneByHost($host);
		return $site;
	}

	public function getView($bundleShort,$view){
		$site=$this->getSite();

		if($this->conf->isCustomView($view)){
			$this->loader->addPath($this->rootDir . '/../sites/'.$site->getName().'/views', 'home');
			return '@home/'.$view;
		}
		else{
			return "@".$bundleShort."/".$view;
		}

	}





}
