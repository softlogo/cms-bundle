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
class SiteSectionAdmin extends Admin
{

	public $conf;
	// Fields to be shown on create/edit forms
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
			->add('section', ModelListType::class, array('required' => false), array())
			->add('number')
			->add('class')

			; 

	}
	// Fields to be shown on filter forms
	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
			->add('site')
			->add('section')
			;
	}
	// Fields to be shown on lists
	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
			->add('site')
			->add('section')

			;
	}

}
