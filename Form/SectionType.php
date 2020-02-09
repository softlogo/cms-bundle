<?php

namespace Softlogo\CMSBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SectionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('anchor')
            ->add('href')
            ->add('itemorder')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('isVisible')
            ->add('isPage')
            ->add('type')
            ->add('parent')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Softlogo\CMSBundle\Entity\Section'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'softlogo_cmsbundle_section';
    }
}
