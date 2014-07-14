<?php

namespace Softlogo\CMSBundle\Controller;

use Softlogo\CMSBundle\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
	public function formAction(Request $request)
	{
		$contact=new Contact();
		$contact->setNazwisko('Borys Jankiewicz');
		$form=$this->createFormBuilder($contact)
			->add('title')
			->add('message')
			->add('email')
			->add('save','submit')
			->getForm();
		$form->handleRequest($request);
		if ($form->isValid()) {
			// perform some action, such as saving the task to the database

			//$this->get('session')->getFlashBag()->add('notice', 'Your changes were saved!');
			$flash = $this->get('braincrafted_bootstrap.flash');
			$flash->success('Formularz został wysłany.');
			return $this->redirect($this->generateUrl('form-informacja'));
		}
		return $this->render("SoftlogoCMSBundle:Contact:form.html.twig", array(
			'form'      => $form->createView(),
		));
	}
	public function informacjaAction(Request $request){
		return $this->render("SoftlogoCMSBundle:Contact:form-informacja.html.twig", array(
			//'form'      => $form->createView(),
		));
	
	}

}
