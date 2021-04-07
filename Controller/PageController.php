<?php

namespace Softlogo\CMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Softlogo\CMSBundle\Entity\Contact;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\TwigBundle\Loader\FilesystemLoader;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Twig\Environment as Twig;
use Doctrine\Persistence\ManagerRegistry as Doctrine;

class PageController extends BaseController
{
	private $loader;
    public function __construct($loader)
    {
		$this->loader=$loader;
    }


	public function showAction($anchor="home", Request $request)
	{
		$em=$this->getEm();
		$conf=$this->get('cms_conf');
		$host=$request->getHost();
		$menu = $this->getRepository()->findBy(array('isMenu'=>true), array('itemorder' => 'ASC'));
		$site=$this->getSiteRepository()->findOneBy(array('host'=>$host));
		$locale = $request->getLocale();
		$page = $this->getRepository()->findOnePage($anchor, $site->getName());
		$this->loader->addPath($this->get('kernel')->getRootDir() . '/../sites/'.$site->getName().'/views', 'home');
		$page->setLocale($locale);
		$em->refresh($page);
		if (!$page) {
			throw $this->createNotFoundException('Unable to find Section entity.');
		}
		$view=$conf->getPageView($page->getType());
		return $this->render($view, array(
			'site'      => $site,
			'page'      => $page,
			'title'      => $page->getTitle(),
			'menu'      => $menu,
		));
	}
}
