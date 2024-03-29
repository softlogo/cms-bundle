<?php

namespace Softlogo\CMSBundle\Extension;

use Softlogo\CMSBundle\Entity\Section;
use Softlogo\CMSBundle\Entity\Page;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Templating\EngineInterface;
use Softlogo\CMSBundle\Services\CMSConfiguration;
use Sonata\ClassificationBundle\Entity\CategoryManager;
use Symfony\Component\Templating\Helper\Helper;
use Symfony\Component\HttpFoundation\Request;

class TwigCMS extends \Twig_Extension{

	protected $container;
	protected $page;
	protected $sectionPager;
	protected $router;
	protected $templating;
	protected $conf;
	protected $galleryManager;
	protected $requestStack;
	protected $request;

	/**
	 * Constructor.
	 *
	 * @param ContainerInterface $container
	 */
	public function __construct($container, $em, $sectionPager, $requestStack,  $mm, $templating, CMSConfiguration $conf)
	{
	    $this->request = $requestStack->getCurrentRequest();
		$this->container = $container;
		$this->em = $em;
		$this->mm = $mm;
		$this->page=$this->getPage();
		$this->sectionPager=$sectionPager;
		//$this->router=$router;
		//$this->urlParams = $this->request->attributes->get('_route_params');
		$this->templating  = $templating;
		$this->conf  = $conf;
	}

	public function getName()
	{
		return 'softlogo_cms';
	}
    //Poprawiony błąd 2021-06-02

	private function getPage(){
		if($this->request){
			$urlParams = $this->request->attributes->get('_route_params');
		}
		$router = $this->container->get('router');
		if($siteHost=$router->getContext()->getHost()){
		}else $siteHost="localhost";
		$anchor=! isset($urlParams['anchor']) ? 'home':$urlParams['anchor'];
		//$anchor=$urlParams['anchor'];
		$locale="pl";

		$language = $this->em->getRepository('SoftlogoCMSBundle:Language')->findOneBy(array('abbr'=>$locale));
		$site = $this->em->getRepository('SoftlogoCMSBundle:Site')->findOneBy(array('host'=>$siteHost));
		if($site){
		return $page = $this->em->getRepository('SoftlogoCMSBundle:Page')->findOnePage($anchor,$site->getName(), $language);
		}else return null;

	}

	public function getFunctions()
	{
		return array(

			new \Twig_Function('render_section', array($this, 'getSection')),
			new \Twig_Function('render_section_by_name', array($this, 'getSectionByName')),
			new \Twig_Function('render_block', array($this, 'getBlock')),
			new \Twig_Function('render_menu', array($this, 'getMenu')),

			/*
			 *'render_section_by_id' => new \Twig_Function_Method($this, 'getSectionById' ,array('is_safe' => array('html'))),
			 *'render_articles' => new \Twig_Function_Method($this, 'getArticles' ,array('is_safe' => array('html'))),
			 */
		);
	}

	public function getFilters()
	{
		return array(
			new \Twig_SimpleFilter('price', array($this, 'priceFilter')),
			new \Twig_SimpleFilter('loc', array($this, 'getFieldByLanguage')),
			new \Twig_SimpleFilter('checkByLoc', array($this, 'checkFieldByLanguage')),
		);
	}

	//FILTRY

	public function getFieldByLanguage($entity,$inputField,$locale=''){
		if($locale==''){$locale=$this->urlParams['_locale'];}
			$getter='get'.ucfirst($inputField);
		if($content=$entity->getContent($locale)){
			return $content->$getter();
		}else return $entity->$getter();
	}

	public function checkFieldByLanguage($entity,$inputField,$locale=''){
		if($locale==''){$locale=$this->urlParams['_locale'];}
			if($entity->getLanguage()){
				$language=$entity->getLanguage()->getAbbr();
			}else $language='pl';


		$getter='get'.ucfirst($inputField);
		if($locale==$language){

			return $entity->$getter();
		}else return null;
	}


	public function priceFilter($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',')
	{
		$price = number_format($number, $decimals, $decPoint, $thousandsSep);
		//$price = '$'.$price;

        return $price;
    }



	//FUNKCJE

	public function getSectionByName($parameters = array())
	{
		
		$entity= $this->em->getRepository('SoftlogoCMSBundle:Section')->findOneBy(array('title'=>$parameters['name']));
		$entityType=$entity->getType();
		$parameters['entity'] =$entity;
		$parameters['type']= $entityType;
		$view=$this->conf->getSectionView($parameters['type']);
		return $this->templating->render($view, $parameters);
	}

	public function getSectionById($parameters = array())
	{
		$entity= $this->em->getRepository('SoftlogoCMSBundle:Section')->findOneBy(array('id'=>$parameters['id']));
		if(empty($entity) || $entity == null) return false;
		$entityType=$entity->getType();
		$parameters['entity'] =$entity;
		$parameters['type']= $entityType;
		$view=$this->conf->getSectionView($parameters['type']);
		return $this->templating->render($view, $parameters);
	}
	
	public function getArticles($parameters = array())
	{
		$entity = $this->em->getRepository('SoftlogoCMSBundle:Section')->findOneBy(array('id'=>$parameters['id']));
		$articles = $entity->getArticles();
		$pagination_limit = 6;
		if(isset($parameters['pagination_limit'])) 	$pagination_limit = intval($parameters['pagination_limit']);
		if(empty($articles) || $articles == null) return false;
		if(isset($parameters['pagination'])){
			$paginator  = $this->container->get('knp_paginator');
			$pagination = $paginator->paginate(
				$articles,
				intval($parameters['request'])/*page number*/,
				$pagination_limit /*limit per page*/
			);
			return $this->templating->render('SoftlogoCMSBundle:Article:!articles.html.twig', array_merge(
				array(
					'articles' => $pagination,
				),
				$parameters
			));
		}else{
			$parameters['pagination'] = false;
			$articles_slice = $articles->slice(0,intval($parameters['request']));
			return $this->templating->render('SoftlogoCMSBundle:Article:!articles2.html.twig', array_merge(
				array(
					'articles' => $articles_slice,
				),
				$parameters
			));
		}
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


		$view=$this->conf->getSectionView($parameters['type']);
		return html_entity_decode($this->templating->render($view, $parameters));

	}

	public function getBlock($parameters = array())
	{
		$collection = $this->em->getRepository('SoftlogoCMSBundle:PageSection')->findBy(array('blockType'=>$parameters['name'], 'page'=>$this->page->getId()), array('itemorder' => 'ASC'));
		$parameters = $parameters + array(
			'collection' => $collection,
			'block' => $parameters['name'],
		);

		$view=$this->conf->getBlockView($parameters['block']);
		return html_entity_decode($this->templating->render($view, $parameters));
	}


	public function getMenu($parameters = array())
	{

    $router = $this->container->get('router');
		if($siteHost=$router->getContext()->getHost()){
		}else $siteHost="localhost";
		$anchor=! isset($urlParams['anchor']) ? 'home':$urlParams['anchor'];
		$locale="pl";

		$language = $this->em->getRepository('SoftlogoCMSBundle:Language')->findOneBy(array('abbr'=>$locale));
		$site = $this->em->getRepository('SoftlogoCMSBundle:Site')->findOneBy(array('host'=>$siteHost));
		//$menu = $this->em->getRepository('SoftlogoCMSBundle:Page')->findBy(array('sites'=>$site->getName()), array('id' => 'ASC'));
		$menu = $this->em->getRepository('SoftlogoCMSBundle:Page')->findBySiteName($site->getName());
		//$menu = $this->em->getRepository('SoftlogoCMSBundle:Page')->findBySiteName($parameters['site']);
		//$menu = $this->em->getRepository('SoftlogoCMSBundle:Page')->findAll();
		$parameters = $parameters + array(
			'collection' => $menu,
			'site' => $site,
			//'sitename' => $site->getName(),
		);

		$view=$this->conf->getMenuView($parameters['type']);
		return $this->templating->render($view, $parameters);
	}




}
