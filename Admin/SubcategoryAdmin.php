<?php
namespace Softlogo\ShopBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\Form\Type\CollectionType;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SubcategoryAdmin extends Admin
{
	// Fields to be shown on create/edit forms
	protected function configureFormFields(FormMapper $formMapper)
	{
		$nested = is_numeric($formMapper->getFormBuilder()->getForm()->getName());
		
		if(!$nested)
			$formMapper->add('category', EntityType::class, array('class' => 'Softlogo\ShopBundle\Entity\Category', 'label' => 'Kategoria'));
		$formMapper
			->add('name', TextType::class, array('label' => 'Nazwa podkategorii'));
			//->add('description', 'ckeditor', array('label' => 'Opis podkategorii'))
		
		if(!$nested)
			$formMapper
				->with('Produkty', array('collapsed' => true))
				->add('products', CollectionType::class, array(
					'label' => 'Produkty',
					'by_reference' => false,
					'required' => false,
					'type_options' => array('delete' => true)
				), array(
					'edit' => 'inline',
					'inline' => 'standard',
					'allow_delete' => true
				))
				;
	}
	
	// Fields to be shown on filter forms
	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
			->add('name')
			->add('category')
		;
	}
	
	// Fields to be shown on lists
	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
			->addIdentifier('name')
			->add('category')
		;
	}
	public function getFormTheme()
	{
		return array_merge(
			parent::getFormTheme(),
			array('SoftlogoShopBundle:Shop:admin.subcategory.html.twig')
		);
	}
}
?>
