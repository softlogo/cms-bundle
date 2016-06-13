<?php
// src/Softlogo/CMSBundle/Admin/PageAdmin.php
namespace Softlogo\CMSBundle\Admin;
use Softlogo\CMSBundle\Entity\Site;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
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
		'site' => array ('value' => 1), // pageType 2 : >
		'_page' => 1, // Display the first page (default = 1)
		'_sort_order' => 'ASC', // Descendant ordering (default = 'ASC')
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

		$formMapper
			->tab('General')
			->with('Content', array('class' => 'col-md-9'))
			->add('name')
			->add('anchor', 'text', array('label' => 'Anchor'))
			->add('articles', 'sonata_type_collection', array('label' => 'Articles', 'required' => false, 'by_reference' => false), array('edit' => 'inline','inline' => 'standard'))
			->end()
			->with('Settings', array('class' => 'col-md-3'))
			->add('itemorder', 'text', array('label' => 'Item Order'))
			->add('media', 'sonata_type_model_list', array('required' => false), array())
			->add('isMenu')
			->add('type', 'choice', array('multiple'=>false, 'choices'=>$this->conf->getKeys('page_types')))
			->add('site')
			->add('page')

			->end()
			->end()

			->tab('Media')
			->with('Media')
			->add('pageMedias', 'sonata_type_collection', array('label' => 'Media', 'required' => false, 'by_reference' => false), array('edit' => 'inline','inline' => 'table'))
			->end()
			->end()



			->tab('SEO')
			->with('SEO', array('class' => 'col-md-6'))
			->add('title', null, array('label' => 'Page Title'))
			->add('description', null, array('label' => 'Page Description'))
			->add('keywords', null, array('label' => 'Page Keywords'))
			->end()
			->end()


			->tab('Languages')
			->with('Content', array('class' => 'col-md-12'))
			->add('articles', 'sonata_type_collection', array('label' => 'Articles', 'required' => false, 'by_reference' => false), array('edit' => 'inline','inline' => 'standard'))
			->add('contents', 'sonata_type_collection', array('label' => 'Wersje językowe', 'required' => false, 'by_reference' => false), array('edit' => 'inline','inline' => 'standard'))

			->end()
			->end()

			->tab('Advanced')
			->with('Settings', array('class' => 'col-md-6'))

			->add('priority')
			->add('href', 'text', array('label' => 'Href', 'required' => false))
			->add('language')
			->end()
			->with('Sections', array('class' => 'col-md-12'))
			->add('pageSections', 'sonata_type_collection', array('label' => 'Sekcje', 'required' => false, 'by_reference' => false), array('edit' => 'inline','inline' => 'table'))
			->end()
			->end()

			;

	}
	// Fields to be shown on filter forms
	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
			->add('site')
			->add('isMenu')
			->add('language')
			;
	}
	// Fields to be shown on lists
	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
			->add('name')
			->addIdentifier('fulltitle')
			->add('page.fulltitle')
			->add('pages')
			->add('itemorder')
			->add('isMenu')
			->add('language')
			->addIdentifier('site.name')
			->add('_action', 'actions', array(
				'actions' => array(
					//'show' => array(),
					'edit' => array(),
				)
			))
			;
	}
	protected function configureShowFields(ShowMapper $showMapper)
	{
		$showMapper

			->add('title')
			->add('articles')
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
