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
class PageSectionAdmin extends Admin
{

	public $conf;
	// Fields to be shown on create/edit forms
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
			->add('section', 'sonata_type_model_list', array('required' => false), array())
			->add('type', 'choice', array('empty_value' => "brak",'multiple'=>false, 'choices'=>$this->conf->getKeys('section_types')))
			->add('blockType', 'choice', array('multiple'=>false, 'choices'=>$this->conf->getKeys('block_types')))
			->add('itemorder')
			//->add('wrapper', 'choice', array('empty_value' => "brak",'multiple'=>false, 'choices'=>$this->conf->getKeys('wrapper_types')))
			//->add('offset', 'choice', array('empty_value' => "brak",'multiple'=>false, 'choices'=>$this->conf->getKeys('offset_types')))
			//->add('anchor')
			->add('class')

			; 

	}
	// Fields to be shown on filter forms
	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
			->add('page')
			->add('section')
			;
	}
	// Fields to be shown on lists
	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
			->add('page')
			->add('section')

			;
	}

}
