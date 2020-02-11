<?php
// src/Softlogo/CMSBundle/Admin/SectionAdmin.php
namespace Softlogo\CMSBundle\Admin;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\FormatterBundle\Form\Type\SimpleFormatterType;
class ArticleAdmin extends Admin
{
	public $conf;

	// Fields to be shown on create/edit forms
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
			->add('title', 'text', array('label' => 'Title'))
			->add('subtitle', 'text', array('label' => 'Subtitle'))
			/*
			 *->add('content', 'sonata_formatter_type', array(
			 *    'event_dispatcher' => $formMapper->getFormBuilder()->getEventDispatcher(),
			 *    'format_field'   => 'contentFormatter',
			 *    'source_field'   => 'rawContent',
			 *    'source_field_options'      => array(
			 *        'attr' => array('class' => 'span10', 'rows' => 20)
			 *    ),
			 *    'listener'       => true,
			 *    'target_field'   => 'content'
			 *))
			 */
			//->add('content', 'sonata_simple_formatter_type', array(
			//'format' => 'markdown'))

			->add('content', SimpleFormatterType::class, [
			'format' => 'text',
			])



			->add('media', 'sonata_type_model_list', array('required' => false), array())
			->add('gallery', 'sonata_type_model_list', array('required' => false), array())
			->add('language')
			->add('itemorder', null, array('label'=>'Itemorder'))
			
			
			//->add('anchor', 'text', array('label' => 'Anchor'))
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
			->add('subtitle')
			->add('content', null, array('safe' => true))
			;

	}
}
