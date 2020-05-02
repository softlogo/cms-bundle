<?php

namespace Softlogo\CMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Softlogo\CMSBundle\Entity\Contact;
use Symfony\Component\HttpFoundation\Request;

class PageController extends BaseController
{

	public function showAction($anchor="home", Request $request)
	{
		$from=$this->container->getParameter('mailer_from');
		$to=$this->container->getParameter('mailer_to');

		$conf=$this->get('cms_conf');
		$host=$this->getHost();

		$menu = $this->getRepository()->findBy(array('isMenu'=>true), array('itemorder' => 'ASC'));
		$sitee= $this->getSiteRepository()->findOneByHost($host);

		$locale = $request->getLocale();
		$language = $this->getLanguageRepository()->findOneBy(array('abbr'=>$locale));

		$page = $this->getRepository()->findOnePage($anchor, $sitee->getName(), $language);

		
		$this->get('twig.loader')->addPath($this->get('kernel')->getRootDir() . '/../sites/'.$sitee->getName().'/views', 'home');

		if (!$page) {
			throw $this->createNotFoundException('Unable to find Section entity.');
		}


		$view=$conf->getPageView($page->getType());


		$contact=new Contact();
		$contact->setNazwisko('Borys Jankiewicz');
		$contact->setTitle('Formularz kontaktowy');
		$form=$this->createFormBuilder($contact)
			->add('message',null,array('label'=>'Wiadomość'))
			->add('email')
			->add('save','submit',array('label'=>'Wyślij'))
			->getForm();
		$form->handleRequest($request);
		if ($form->isValid()) {
			$mailHelper = $this->container->get('mail_helper');
  
			$mailHelper->sendEmailWithView(
				$from,
				$to,
				$contact->getTitle(),
				"SoftlogoCMSBundle:Contact:contact.html.twig",
				array(
					"message"=>$contact->getMessage(),
					"email"=>$contact->getEmail()
				)
			);

			$flash = $this->get('braincrafted_bootstrap.flash');
			$flash->success('Formularz został wysłany.');
			//return $this->redirect($this->generateUrl('form-informacja'));
		}


		return $this->render($view, array(
			'site'      => $sitee,
			'page'      => $page,
			'title'      => $page->getTitle(),
			'menu'      => $menu,
			'form'      => $form->createView(),
		));
	}
}
