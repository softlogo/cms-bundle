<?php
// src/Softlogo/CMSBundle/Admin/SectionAdmin.php
namespace Softlogo\CMSBundle\Admin;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
class ArticleAdmin extends Admin
{
	public $conf;

	// Fields to be shown on create/edit forms
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
			->add('title', 'text', array('label' => 'Title'))
			->add('abstract', null, array('label' => 'Abstract'))
			->add('type', 'choice', array('multiple'=>false, 'choices'=>$this->conf->getKeys('article_types')))
			->add('itemorder', null, array('label'=>'Itemorder'))
			->add('content', 'ckeditor', array('label' => 'Content'))
			/*
			 *->add('shortContent', 'sonata_formatter_type', array(
			 *    'source_field'         => 'rawContent',
			 *    'source_field_options' => array('attr' => array('class' => 'span10', 'rows' => 20)),
			 *    'format_field'         => 'contentFormatter',
			 *    'target_field'         => 'content',
			 *    'ckeditor_context'     => 'default',
			 *    'event_dispatcher'     => $formMapper->getFormBuilder()->getEventDispatcher()
			 *))
			 */
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
			;
	}
}
