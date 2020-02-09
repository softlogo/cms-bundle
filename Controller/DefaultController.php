<?php

namespace Softlogo\CMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Config\Definition\Processor;
use Softlogo\CMSBundle\DependencyInjection\Configuration;
class DefaultController extends Controller
{
    public function indexAction($name=null)
    {
		$conf=$this->get('cms_conf');
		$view=$conf->getView('gallery');
        return $this->render('SoftlogoCMSBundle:Default:index.html.twig', array('widok' => $view));
    }
}
