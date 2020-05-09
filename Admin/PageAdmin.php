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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\Form\Type\CollectionType;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
		//'site' => array ('value' => 1), // pageType 2 : >
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
/*
 *    public function createQuery($context = 'list')
 *    {
 *        $queryBuilder = $this->getModelManager()->getEntityManager($this->getClass())->createQueryBuilder();
 *
 *        $queryBuilder->select('p')
 *            ->from($this->getClass(), 'p')
 *            //->andWhere('p.page is null')
 *            ->orderby('p.site desc, p.isMenu desc,  p.page, p.itemorder');
 *
 *
 *        $proxyQuery = new ProxyQuery($queryBuilder);
 *        return $proxyQuery;
 *    }
 */
	// Fields to be shown on create/edit forms
	protected function configureFormFields(FormMapper $formMapper)
	{




		$formMapper
			->tab('General')
			->with('Content', array('class' => 'col-md-9'))
			->add('name')
			->add('anchor', TextType::class, array('label' => 'Anchor'))
			->add('articles', CollectionType::class, array('label' => 'Articles', 'required' => false, 'by_reference' => false), array('edit' => 'inline','inline' => 'standard', 'sortable'=>true))

			->end()
			->with('Settings', array('class' => 'col-md-3'))
			->add('itemorder', TextType::class, array('label' => 'Item Order'))
			->add('media', ModelListType::class, array('required' => false), array())
			->add('isMenu')
			->add('type', ChoiceType::class, array('multiple'=>false, 'choices'=>$this->conf->getKeys('page_types')))
			->add('page', ModelListType::class, array('required' => false), array())
			//->add('site', ModelListType::class, array('required' => false), array())

			->end()




			->end()
			;

		//if($this->getConfigurationPool()->getContainer()->get('security.context')->isGranted('ROLE_SUPER_ADMIN') and false) {
			$formMapper

				->tab('General')
				->with('Settings', array('class' => 'col-md-3'))
				->add('sites')
				->end()
				->end()
				;
		//}	

		$formMapper

			->tab('Media')
			->with('Media')
			->add('pageMedias', CollectionType::class, array('label' => 'Media', 'required' => false, 'by_reference' => false), array('edit' => 'inline','inline' => 'table'))
			->end()
			->end()



			->tab('SEO')
			->with('SEO', array('class' => 'col-md-6'))
			->add('title', null, array('label' => 'Page Title'))
			->add('description', null, array('label' => 'Page Description'))
			->add('keywords', null, array('label' => 'Page Keywords'))
			->end()
			->end()


/*
 *                ->tab('Languages')
 *                ->with('Content', array('class' => 'col-md-12'))
 *                ->add('articles', CollectionType::class, array('label' => 'Articles', 'required' => false, 'by_reference' => false), array('edit' => 'inline','inline' => 'standard'))
 *                ->add('contents', CollectionType::class, array('label' => 'Wersje językowe', 'required' => false, 'by_reference' => false), array('edit' => 'inline','inline' => 'standard'))
 *
 *                ->end()
 *                ->end()
 */

				->tab('Advanced')
				->with('Settings', array('class' => 'col-md-6'))

				->add('priority')
				->add('isDropdown')
				->add('href', TextType::class, array('label' => 'Href', 'required' => false))
				->end()
				->with('Sections', array('class' => 'col-md-12'))
				->add('pageSections', CollectionType::class, array('label' => 'Sekcje', 'required' => false, 'by_reference' => false), array('edit' => 'inline','inline' => 'table'))
				->end()
				->end()

				;

	}
	// Fields to be shown on filter forms
	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
			->add('isMenu')
			->add('language')
			;
	}
	// Fields to be shown on lists
	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
			->add('name')
			->add('page.fulltitle')
			->add('sites')
			//->add('pages')
			->add('itemorder')
			->add('isMenu')
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

	public function getNewInstance()
	{
		$host=$this->getConfigurationPool()->getContainer()->get('router')->getContext()->getHost();
		$sites=$this->getConfigurationPool()
			->getContainer()
			->get('doctrine')
			->getRepository("SoftlogoCMSBundle:Site")
			->findByHost($host);
		$site=$sites[0];

		$newPage = parent::getNewInstance();
		$newPage->addSite($site);
		//$site->addPage($newPage);

		return $newPage;
	}
}
