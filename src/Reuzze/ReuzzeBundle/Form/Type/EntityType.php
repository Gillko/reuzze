<?php
/**
 * Created by PhpStorm.
 * User: gillesvanpeteghem
 * Date: 30/12/13
 * Time: 18:55
 */

namespace Reuzze\ReuzzeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EntityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category'     , new CategoryType())
            ->add('entityTitle'   , 'text', array(
            'label' => 'Title',
            'attr' => array('placeholder' => 'Title')
            ))
            ->add('entityDescription'  , 'text', array(
                'label' => 'Description',
                'attr' => array('placeholder' => 'Description')
            ))
            ->add('entityStarttime', 'datetime', array(
                'label'         => 'Start Time',
                'empty_value'   => '',
                'required'      => false
            ))
            ->add('entityEndtime', 'datetime', array(
                'label'         => 'End Time',
                'empty_value'   => '',
                'required'      => false
            ))
            ->add('entityInstantsellingprice', 'money', array(
                'label'         => 'Instant Selling Price',
                'attr' => array('placeholder' => 'Instant Selling Price')
            ))
            ->add('entityCondition', 'choice', array(
                'choices' => array('n' => 'New', 'u' => 'Used'),
                'label'         => 'Condition',
                'attr' => array('placeholder' => 'Condition')
            ))
        ;
    }

    public function getName()
    {
        return 'entity';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Reuzze\ReuzzeBundle\Entity\Entities',
            'validation_groups' => array('entity'),
        ));
    }

}

