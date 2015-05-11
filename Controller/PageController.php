<?php

namespace Softlogo\CMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Softlogo\CMSBundle\Entity\Contact;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller
{
	public function getRepository()
	{
		$em = $this->getDoctrine()->getManager();
		return $em->getRepository('SoftlogoCMSBundle:Page');
	}
	public function showAction($anchor="home",$site="main", Request $request)
	{
		$from=$this->container->getParameter('mailer_from');
		$to=$this->container->getParameter('mailer_to');

		$conf=$this->get('cms_conf');

		$menu = $this->getRepository()->findBy(array('isMenu'=>true), array('itemorder' => 'ASC'));
		$page = $this->getRepository()->findOneByAnchor($anchor);

		if (!$page) {
			throw $this->createNotFoundException('Unable to find Section entity.');
		}


		$view=$conf->getPageView($page->getType());
		//$view=$conf->getPageView('home');

		if ( $this->get('templating')->exists("SoftlogoCMSBundle:Page:$view"))
		{
			$viewpath="SoftlogoCMSBundle:Page:$view";
		}else $viewpath="SoftlogoCMSBundle:Page:page.html.twig";


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


		return $this->render($viewpath, array(
			'site'      => $site,
			'page'      => $page,
			'title'      => $page->getTitle(),
			'menu'      => $menu,
			'form'      => $form->createView(),
		));
	}
}
