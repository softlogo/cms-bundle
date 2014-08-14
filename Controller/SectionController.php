<?php

namespace Softlogo\CMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Softlogo\CMSBundle\Entity\Section;

class SectionController extends Controller
{
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SoftlogoCMSBundle:Section')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Nie ma takiej sekcji');
        }
        return $this->render("SoftlogoCMSBundle:Section:show.html.twig", array(
                'section'=>$entity
            ));    }

}
