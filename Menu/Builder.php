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
		$host=$request->get('host');
		$site=$this->siteRep->findOneByHost($host);

		$pages = $this->pageRep->findBy(array('isMenu'=>true), array('itemorder' => 'ASC'));

		$menu = $this->factory->createItem('root');
		foreach($pages as $page){
			if($page->getHref()){
				$item=$menu->addChild($page->getName(), array(
					'uri' => $page->getHref(),	
				));
				if(strpos($request->getRequestUri(), $page->getHref())!==false){
					$item->setCurrent(true);
				}

			}else{
				$item=$menu->addChild($page->getName(), array(
					'route' => 'cms_page',
					'routeParameters' => array('anchor' => $page->getAnchor(), 'host'=>$page->getSite()->getHost()),
				));

			}
			if($type=="drop-down"){
				foreach($page->getPages() as $subPage){

					$subItem=$item->addChild($subPage->getName(), array(
						'route' => 'cms_page',
						'routeParameters' => array('anchor' => $subPage->getAnchor(), 'host'=>$subPage->getSite()->getHost()),
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
