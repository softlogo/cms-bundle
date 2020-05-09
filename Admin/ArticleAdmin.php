<?php
// src/Softlogo/CMSBundle/Admin/SectionAdmin.php
namespace Softlogo\CMSBundle\Admin;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\FormatterBundle\Form\Type\SimpleFormatterType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\Form\Type\CollectionType;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Sonata\AdminBundle\Form\Type\ChoiceFieldMaskType;
class ArticleAdmin extends Admin
{
	public $conf;

	// Fields to be shown on create/edit forms
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
			->add('title', TextType::class, array('label' => 'Title'))
			->add('subtitle', TextType::class, array('label' => 'Subtitle'))
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
			'format' => 'richhtml',
			])



			->add('media', ModelListType::class, array('required' => false), array())
			//->add('gallery', ModelListType::class, array('required' => false), array())


			//->add('anchor', 'text', array('label' => 'Anchor'))
			->add('name', ChoiceFieldMaskType::class, [
			'choices' => [
			'simple' => 'simple',
			'extended' => 'extended',
			],
			'data' => 'simple',
			'map' => [
			'simple' => ['title'],
			'extended' => ['title', 'subtitle', 'media'],
			],
			'placeholder' => 'Choose an option',
			'required' => false
			])

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
