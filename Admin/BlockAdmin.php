<?php
// src/Softlogo/CMSBundle/Admin/BlockAdmin.php
namespace Softlogo\CMSBundle\Admin;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\Form\Type\CollectionType;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class BlockAdmin extends Admin
{
	public $conf;
	protected $datagridValues = array (
		'_page' => 1, // Display the first page (default = 1)
		'_sort_order' => 'asc', // Descendant ordering (default = 'ASC')
		'_sort_by' => 'name' // name of the ordered field (default = the model id field, if any)
	);

	// Fields to be shown on create/edit forms
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
			->add('name', 'text', array('label' => 'Name'))
			->add('description', null, array('label' => 'Description'))
			; 

	}
	// Fields to be shown on filter forms
	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
			->add('name')
			;
	}
	// Fields to be shown on lists
	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
			->addIdentifier('name')
			;
	}
}
