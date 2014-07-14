<?php
// src/Softlogo/CMSBundle/Admin/PageAdmin.php
namespace Softlogo\CMSBundle\Admin;
use Softlogo\CMSBundle\Entity\Site;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery; 
class PageAdmin extends Admin
{
	public $conf;

	/*
	 *protected $baseRouteName = 'admin_vendor_bundlename_adminclassname';
	 *protected $baseRoutePattern = 'unique-route-pattern';
	 */

   /**
    * Default Datagrid values
    *
    * @var array
    */
   protected $datagridValues = array (
           'isMenu' => array ('value' => false), // pageType 2 : >
           '_page' => 1, // Display the first page (default = 1)
           '_sort_order' => 'ASC', // Descendant ordering (default = 'ASC')
           '_sort_by' => 'site.id' // name of the ordered field (default = the model id field, if any)
      // the '_sort_by' key can be of the form 'mySubModel.mySubSubModel.myField'.
   );
    /**
     * Override to order products by name and creationdate
     * 
     * @param string $context
     * 
     * @return \Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery 
     */
    public function createQuery($context = 'list')
    {
        $queryBuilder = $this->getModelManager()->getEntityManager($this->getClass())->createQueryBuilder();
 
        $queryBuilder->select('p')
                             ->from($this->getClass(), 'p')
							 //->andWhere('p.page is null')
							 ->orderby('p.site desc, p.isMenu desc,  p.page, p.itemorder');

 
        $proxyQuery = new ProxyQuery($queryBuilder);
        return $proxyQuery;
    }
	// Fields to be shown on create/edit forms
	protected function configureFormFields(FormMapper $formMapper)
	{
		//$conf=new CMSConfiguration();
		//$conf=$this->container->get('cms_conf');
		$nested = is_numeric($formMapper->getFormBuilder()->getForm()->getName());
		$formMapper
			->add('title', 'text', array('label' => 'Page Title'))
			->add('subtitle')
			->add('itemorder', 'text', array('label' => 'Item Order'))
			->add('anchor', 'text', array('label' => 'Anchor'))
			->add('type', 'choice', array('multiple'=>false, 'choices'=>$this->conf->getKeys('page_types')));
		if(!$nested){
		
		$formMapper
			->add('site')
			->add('page')
			->add('href', 'text', array('label' => 'Href', 'required' => false))
			->add('isMenu')
			->add('articles', 'sonata_type_collection', array('label' => 'Articles', 'required' => false, 'by_reference' => false), array('edit' => 'inline','inline' => 'standard'))
			->add('pages', 'sonata_type_collection', array('label' => 'Pages', 'required' => false, 'by_reference' => false), array('edit' => 'inline','inline' => 'table'))
			->add('pageSections', 'sonata_type_collection', array('label' => 'Sekcje', 'required' => false, 'by_reference' => false), array('edit' => 'inline','inline' => 'table'))
			; 
		}
	}
	// Fields to be shown on filter forms
	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
			->add('site')
			->add('isMenu')
			->add('itemorder')
			;
	}
	// Fields to be shown on lists
	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
			->addIdentifier('fulltitle')
			->add('page.fulltitle')
			->add('pages')
			->add('itemorder')
			->add('isMenu')
			->addIdentifier('site.name')
			;
	}
	/*
	 *public function getFormTheme()
	 *{
	 *    return array_merge(
	 *        parent::getFormTheme(),
	 *        array('SoftlogoCMSBundle:CMS:admin.section.html.twig')
	 *    );
	 *}
	 */
}
