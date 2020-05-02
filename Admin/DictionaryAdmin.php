<?php

namespace Softlogo\CMSBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\Form\Type\CollectionType;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DictionaryAdmin extends Admin
{
	protected $datagridValues = array (
		'isMain' => array ('value' => 1), // sectionType 2 : >
		'_page' => 1, // Display the first page (default = 1)
		'_sort_order' => 'DESC', // Descendant ordering (default = 'ASC')
		// the '_sort_by' key can be of the form 'mySubModel.mySubSubModel.myField'.
	);

	/**
	 * @param DatagridMapper $datagridMapper
	 */
	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
			->add('id')
			->add('name')
			->add('isMain')
			->add('description')
			->add('itemorder')
			->add('dictionary')
			;
	}

	/**
	 * @param ListMapper $listMapper
	 */
	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
			->add('name')
			//->add('dictionary')
			->add('itemorder')
			->add('_action', 'actions', array(
				'actions' => array(
					'show' => array(),
					'edit' => array(),
					'delete' => array(),
				)
			))
			;
	}

	/**
	 * @param FormMapper $formMapper
	 */
	protected function configureFormFields(FormMapper $formMapper)
	{
		$nested = is_numeric($formMapper->getFormBuilder()->getForm()->getName());

		$formMapper
			->add('name');
		if(!$nested){
			$formMapper
			->add('description')
			->add('isMain');
		}
		$formMapper
			->add('value')
			->add('itemorder')
			//->with('Options', array('collapsed' => false))
			->add('dictionaries', CollectionType::class, array('label' => 'Dictionaries', 'required' => false, 'by_reference' => false), array('edit' => 'inline','inline' => 'table',))
			//->end()
			;
	}

	/**
	 * @param ShowMapper $showMapper
	 */
	protected function configureShowFields(ShowMapper $showMapper)
	{
		$showMapper
			->add('name')
			->add('description')
			->add('value')
			->add('itemorder')
			;
	}
}
