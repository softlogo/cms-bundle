<?php // src/Softlogo/CMSBundle/Controller/CRUDController.php

namespace Softlogo\CMSBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Softlogo\CMSBundle\Util\SoftlogoAuditReader as Reader;
use SimpleThings\EntityAudit\Metadata\MetadataFactory;
use SimpleThings\EntityAudit\AuditConfiguration;

class CRUDController extends Controller
{
    public function restoreAction($id=6, $revision=80)
    {
		$revision=$_GET['revision'];
        $object = $this->admin->getSubject();
		$em = $this->container->get('doctrine')->getEntityManager(); 
		$className = $em->getClassMetadata(get_class($object))->getName();
		$auditedEntities[0]=$className;
		$factory=new MetadataFactory($auditedEntities);
		$config= new AuditConfiguration();
		//$id=$object->getId();



		/*
         *if (!$object) {
         *    throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
         *}
		 */
		$reader= new Reader($em, $config, $factory);
		$reader->restore($className, $id, $revision);
        $this->addFlash('sonata_flash_success',"Przywrócono wcześniejszą wersję." );

        //return new RedirectResponse($this->admin->generateUrl('view'));
        return new RedirectResponse($this->admin->generateObjectUrl('history_view_revision', $object, array('revision'=>$revision)) );
    }

    public function cloneAction()
    {
        $object = $this->admin->getSubject();

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        $clonedObject = clone $object;  // Careful, you may need to overload the __clone method of your object
                                        // to set its id to null
        $clonedObject->setName($object->getName()." (Kopia)");

        $this->admin->create($clonedObject);

        $this->addFlash('sonata_flash_success', 'Cloned successfully');

        return new RedirectResponse($this->admin->generateUrl('list'));
    }

}
