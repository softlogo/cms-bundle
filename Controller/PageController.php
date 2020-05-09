<?php

namespace Softlogo\CMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Softlogo\CMSBundle\Entity\Contact;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\TwigBundle\Loader\FilesystemLoader;

class PageController extends BaseController
{
/*
 *    private $loader;
 *
 *    public function __construct(FilesystemLoaderm $loader){
 *        $this->loader=$loader;
 *    
 *    }
 */

	public function showAction($anchor="home", Request $request)
	{
		//echo $this->getParameter("kernel.project_dir");
		echo getcwd();
		$from=$this->container->getParameter('mailer_from');
		$to=$this->container->getParameter('mailer_to');

		$conf=$this->get('cms_conf');
		$host=$request->getHost();


		$menu = $this->getRepository()->findBy(array('isMenu'=>true), array('itemorder' => 'ASC'));
		$sitee=$this->getSiteRepository()->findOneBy(array('host'=>$host))->getName();

		$locale = $request->getLocale();
		$language = $this->getLanguageRepository()->findOneBy(array('abbr'=>$locale));

		$page = $this->getRepository()->findOnePage($anchor, $sitee, $language);

		
		//$loader=$this->get('twig.loader');
		//$loader->addPath($this->get('kernel')->getRootDir() . '/../sites/'.$sitee->getName().'/views', 'home');
		//$this->addHomePath();

		if (!$page) {
			throw $this->createNotFoundException('Unable to find Section entity.');
		}


		$view=$conf->getPageView($page->getType());


		return $this->render($view, array(
			'site'      => $sitee,
			'page'      => $page,
			'title'      => $page->getTitle(),
			'menu'      => $menu,
			//'form'      => $form->createView(),
		));
	}
}
