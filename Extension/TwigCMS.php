<?php

namespace Softlogo\CMSBundle\Extension;

use Softlogo\CMSBundle\Entity\Section;
use Softlogo\CMSBundle\Entity\Page;

class TwigCMS extends \Twig_Extension{

	protected $container;
	protected $page;
	protected $sectionPager;

	/**
	 * Constructor.
	 *
	 * @param ContainerInterface $container
	 */
	public function __construct($container, $em, $sectionPager)
	{
		$this->container = $container;
		$this->em = $em;
		$this->page=$this->getPage();
		$this->sectionPager=$sectionPager;
	}

	public function getName()
	{
		return 'softlogo_cms';
	}

	private function getPage(){
		if($this->container->isScopeActive('request')){
			$urlParams = $this->container->get('request')->attributes->get('_route_params');
		}
		$anchor=! isset($urlParams['anchor']) ? 'home':$urlParams['anchor'];
		return $page = $this->em->getRepository('SoftlogoCMSBundle:Page')->findOneBy(array('anchor'=>$anchor));

	}

	public function getFunctions()
	{
		return array(
			'render_section' => new \Twig_Function_Method($this, 'getSection' ,array('is_safe' => array('html'))),
			'render_section_by_name' => new \Twig_Function_Method($this, 'getSectionByName' ,array('is_safe' => array('html'))),
			'render_block' => new \Twig_Function_Method($this, 'getBlock' ,array('is_safe' => array('html'))),
			'render_menu' => new \Twig_Function_Method($this, 'getMenu' ,array('is_safe' => array('html'))),
		);
	}
	public function getSectionByName($parameters = array())
	{
		$entity= $this->em->getRepository('SoftlogoCMSBundle:Section')->findOneBy(array('title'=>$parameters['name']));
		$entityType=$entity->getType();
		$parameters['entity'] =$entity;
		$parameters['type']= $entityType;
		return $this->container->get('softlogo.CMSHelper')->section($parameters);
	}


	public function getSection($parameters = array())
	{
		if(isset($parameters['entity'])){
			$entityOryg=$parameters['entity'];
			$this->sectionPager->setSection($entityOryg);
			$entity=$this->sectionPager->getSectionsPage(1);

			$entityTitle=$entity->getTitle();
			//$entityType=$entity->getSectionType()->__toString();
			$entityType=$entity->getType();
			$parameters['type']= ! isset($parameters['type']) ? $entityType : $parameters['type'];

			/*
			 *Robię wyjątak w sytuacji gdy używam artykułów ze strony
			 */
			if($entityTitle=='Main'){
				$section=new Section();
				$section->addArticleCollection($this->page->getArticles());
				$section->setTitle($this->page->getTitle());
				$parameters['entity']=$section;

			} elseif($entityTitle=='Main - First'){
				$section=new Section();
				$section->addArticle($this->page->getFirstArticle());
				$section->setTitle($this->page->getTitle());
				$parameters['entity']=$section;

			} elseif($entityTitle=='Main - Last'){
				$section=new Section();
				$section->addArticleCollection($this->page->getLastArticles());
				$section->setTitle($this->page->getTitle());
				$parameters['entity']=$section;

			}

		}else{
			$section=new Section();
			$section->addArticleCollection($this->page->getArticles());
			$section->setTitle($this->page->getTitle());
			$parameters['entity']=$section;
			//$parameters['type']=='';

		}
		return $this->container->get('softlogo.CMSHelper')->section($parameters);
	}

	public function getBlock($parameters = array())
	{
		$collection = $this->em->getRepository('SoftlogoCMSBundle:PageSection')->findBy(array('blockType'=>$parameters['name'], 'page'=>$this->page), array('itemorder' => 'ASC'));
		$parameters = $parameters + array(
			'collection' => $collection,
			'block' => $parameters['name'],
		);

		return $this->container->get('softlogo.CMSHelper')->block($parameters);
	}


	public function getMenu($parameters = array())
	{

		$site = $this->em->getRepository('SoftlogoCMSBundle:Site')->findOneBy(array('name'=>$parameters['sitename']), array('id' => 'ASC'));
		$menu = $this->em->getRepository('SoftlogoCMSBundle:Page')->findBy(array('isMenu'=>true,'site'=>$site), array('itemorder' => 'ASC'));
		//$menu = $this->em->getRepository('SoftlogoCMSBundle:Page')->findBySiteName($parameters['site']);
		//$menu = $this->em->getRepository('SoftlogoCMSBundle:Page')->findAll();
		$parameters = $parameters + array(
			'collection' => $menu,
			'site' => $site,
		);

		return $this->container->get('softlogo.CMSHelper')->menu($parameters);
	}


}
