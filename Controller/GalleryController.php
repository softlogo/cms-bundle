<?php
namespace Softlogo\CMSBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;
use Softlogo\CMSBundle\Util\PageParams;
use Sonata\ClassificationBundle\Entity\CategoryManager;
use Doctrine\ORM\EntityManager;

class GalleryController
{
    private $templating;
    private $pp;

    public function __construct(EngineInterface $templating, PageParams $pp, CategoryManager $cm, EntityManager $em, $mm)
    {
        $this->templating = $templating;
        $this->pageParams = $pp;
        $this->cm = $cm;
        $this->em = $em;
        $this->mm = $mm;
    }

/*
 *    public function indexAction($id)
 *    {
 *        $medias=$this->mm->findBy(array('category'=>$id));
 *
 *        $categories=$this->cm->getSubCategoriesPager($id, 1, 25);
 *        $array=array(
 *            'categories' => $categories,
 *            'medias' => $medias,
 *        );
 *
 *        return $this->templating->renderResponse(
 *            'SoftlogoCMSBundle:Gallery:gallery.html.twig',
 *            array_merge($array,$this->pageParams->params())
 *        
 *        );
 *
 *    }
 */
	public function indexAction($id){
		return $this->render($id,'gallery');
	}
	public function galleriesAction($id){
		return $this->render($id,'galleries');
	}

    public function render($id, $view)
    {

		$category=$this->cm->findBy(array('id'=>$id))[0];
		$rootCategory=$category->getParent();
		$medias=$this->mm->findBy(array('category'=>$id));
		$categories=$this->cm->getSubCategoriesPager($id, 1, 25);
		foreach($categories as $category){
			$medias=array_merge($medias, $this->mm->findBy(array('category'=>$category->getId())));
		}
		$array=array(
			'categories' => $categories,
			'category' => $category,
			'rootCategory' => $rootCategory,
			'medias' => $medias,
		);

        return $this->templating->renderResponse(
            'SoftlogoCMSBundle:Gallery:'.$view.'.html.twig',
			array_merge($array,$this->pageParams->params())
		
		);

    }


}
