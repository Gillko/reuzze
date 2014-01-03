<?php

namespace Reuzze\ReuzzeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*$builder->add('regionName'   , 'text', array(
            'label' => 'Region Name',
            'attr' => array('placeholder' => 'Region Name')
        ));*/

        $builder->add('categoryName', 'entity', array(
            'class' => 'ReuzzeReuzzeBundle:Categories',
            'property' => 'categoryName',
            'expanded' => false,
            'multiple' => false
        ));
    }

    public function getName()
    {
        return 'category';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Reuzze\ReuzzeBundle\Entity\Categories',
        ));
    }

}

