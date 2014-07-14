<?php

namespace Softlogo\CMSBundle\Templating\Helper;

use Symfony\Component\Templating\Helper\Helper;
use Symfony\Component\Templating\EngineInterface;
use Softlogo\CMSBundle\Services\CMSConfiguration;

class CMSHelper extends Helper
{
	protected $templating;

	public function __construct(EngineInterface $templating, CMSConfiguration $conf)
	{
		$this->templating  = $templating;
		$this->conf  = $conf;
	}


	public function section($parameters)
	{
		$view=$this->conf->getSectionView($parameters['type']);
		return $this->templating->render("SoftlogoCMSBundle:CMS:$view", $parameters);
	}

	public function block($parameters)
	{
		$view=$this->conf->getBlockView($parameters['block']);
		return $this->templating->render("SoftlogoCMSBundle:Block:$view", $parameters);
	}

	public function menu($parameters)
	{
		$view=$this->conf->getMenuView($parameters['type']);
		return $this->templating->render("SoftlogoCMSBundle:Menu:$view", $parameters);
	}

	public function getName()
	{
		return 'cms';
	}
}
