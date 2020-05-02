<?php
// src/Acme/DemoBundle/Menu/Builder.php
namespace Softlogo\CMSBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class Builder
{
	private $factory;
	private $em;
	private $siteRep;
	private $pageRep;

	/**
	 * @param FactoryInterface $factory
	 */
	public function __construct(FactoryInterface $factory, $em)
	{
		$this->factory = $factory;
		$this->em = $em;
		$this->siteRep=$em->getRepository('SoftlogoCMSBundle:Site');
		$this->pageRep=$em->getRepository('SoftlogoCMSBundle:Page');
	}

	public function menu(RequestStack $requestStack, $type="drop-down")
	{
		$request=$requestStack->getCurrentRequest();
		$host=$request->getHost();
		$site=$this->siteRep->findOneByHost($host);

		$pages = $this->pageRep->findBy(array('isMenu'=>true, 'isVisible' => 1), array('itemorder' => 'ASC'));

		$menu = $this->factory->createItem('root', array(
			'childrenAttributes'    => array(
			'class'             => 'nav-links navbar-nav',
			)
		));
		
		foreach($pages as $page){
			
			if($page->getHref()){
				$item=$menu->addChild($page->getName(), array(
				'uri' => $page->getHref(),	
				))
				->setAttribute('class', '')
				->setLinkAttribute('class', 'main-menu');
				if(strpos($request->getRequestUri(), $page->getHref())!==false){
					$item->setCurrent(true);
				}
			}else{
				$num = count($page->getPages());
				if($num > 0){
					$item=$menu->addChild($page->getName(), array(
						'route' => 'cms_page',
						'routeParameters' => array('anchor' => $page->getAnchor()),
					))
					->setAttribute('class', '')
					->setLinkAttribute('class', 'main-menu')
					->setChildrenAttribute('class', 'dropdown-menu edugate-dropdown-menu-1');
				}else{
					$item=$menu->addChild($page->getName(), array(
						'route' => 'cms_page',
						'routeParameters' => array('anchor' => $page->getAnchor()),
					))
					->setAttribute('class', '')
					->setLinkAttribute('class', 'main-menu');
				}

			}
			
			if($type=="drop-down"){
				foreach($page->getPages() as $subPage){
					$item->setAttribute('class', 'dropdown');
					$subItem=$item->addChild($subPage->getName(), array(
						'route' => 'cms_page',
						'routeParameters' => array('anchor' => $subPage->getAnchor()),
					));
					//if($subItem->isCurrent()!=false){
					//$item->setCurrent(true);
					//}
					foreach($subPage->getPages() as $subSubPage){

						$subSubItem=$subItem->addChild($subSubPage->getName(), array(
							'route' => 'cms_page',
							'routeParameters' => array('anchor' => $subSubPage->getAnchor(), 'host'=>$subSubPage->getSite()->getHost()),
						));


					}


				}
			}

		}



		return $menu;
	}

	public function mainMenu(RequestStack $requestStack)
	{
		return $this->menu($requestStack, "drop-down");
	}
	public function flatMenu(RequestStack $requestStack)
	{
		return $this->menu($requestStack, "flat");
	}

}
