<?php
// src/Softlogo/CMSBundle/Admin/SectionAdmin.php
namespace Softlogo\CMSBundle\Admin;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\Form\Type\CollectionType;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class SectionAdmin extends Admin
{

	public $conf;
	/**
	 * Default Datagrid values
	 *
	 * @var array
	 */
	protected $datagridValues = array (
		//'isPage' => array ('sectionType' => 1, 'value' => 2), // sectionType 2 : >
		//'isMainSection' => array ('value' => 1), // sectionType 2 : >
		'_page' => 1, // Display the first page (default = 1)
		'_sort_order' => 'DESC', // Descendant ordering (default = 'ASC')
		'_sort_by' => 'id, isMainSection' // name of the ordered field (default = the model id field, if any)
		// the '_sort_by' key can be of the form 'mySubModel.mySubSubModel.myField'.
	);
	// Fields to be shown on create/edit forms
	protected function configureFormFields(FormMapper $formMapper)
	{
		if ($this->hasRequest()) {
			$link_parameters = array('context' => $this->getRequest()->get('context'));
		} else {
			$link_parameters = array();
		}
		$nested = is_numeric($formMapper->getFormBuilder()->getForm()->getName());
		$formMapper
			->with('Section')
			->add('title', TextType::class, array('label' => 'Title'))
			->add('itemorder', TextType::class, array('label' => 'Item Order'))
			->add('type', ChoiceType::class, array('multiple'=>false, 'choices'=>$this->conf->getKeys('section_types')))
			->end()
			;


		if(!$nested){

			$formMapper
				->with('Media')
				->add('sectionMedias', CollectionType::class, array('label' => 'Media', 'required' => false, 'by_reference' => false), array('edit' => 'inline','inline' => 'table'))
				->end()
				->add('articles', CollectionType::class, array('label' => 'Articles', 'required' => false, 'by_reference' => false), array('edit' => 'inline','inline' => 'standard'))
				->end()
				->end()
				; 

		}
	}
	// Fields to be shown on filter forms
	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
			->add('parent')
			->add('type')
			->add('isMainSection')
			//->add('parent.isPage')
			;
	}
	// Fields to be shown on lists
	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
			->add('title')
			->add('parent')
			->add('itemorder')
			->add('type', 'choice')
			->add('isMainSection', null, array('editable' => true))
			->add('_action', 'actions', array(
				'actions' => array(
					//'show' => array(),
					'edit' => array(),
				)
			))
			;

		;
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
