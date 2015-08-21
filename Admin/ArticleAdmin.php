<?php
// src/Softlogo/CMSBundle/Admin/SectionAdmin.php
namespace Softlogo\CMSBundle\Admin;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
class ArticleAdmin extends Admin
{
	public $conf;

	// Fields to be shown on create/edit forms
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
			->add('title', 'text', array('label' => 'Title'))
			->add('anchor', 'text', array('label' => 'Anchor'))
			->add('itemorder', null, array('label'=>'Itemorder'))
			->add('content', 'ckeditor', array('label' => 'Content'))
			->add('media', 'sonata_type_model_list', array('required' => false), array())
			->add('language')
			; 

	}
	// Fields to be shown on filter forms
	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
			->add('title')
			;
	}
	// Fields to be shown on lists
	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
			->addIdentifier('title')
			->addIdentifier('page.title',null, array('label' => 'Page'))
			->addIdentifier('language.name',null, array('label' => 'Content'))
			;
	}

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper

            ->add('title')
            ->add('content', null, array('safe' => true))
        ;

    }
}
