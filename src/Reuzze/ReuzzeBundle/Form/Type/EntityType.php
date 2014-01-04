<?php

namespace Reuzze\ReuzzeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Doctrine\ORM\EntityManager;

class EntityType extends AbstractType
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category'     , new CategoryType($this->em))
            ->add('entityTitle'   , 'text', array(
            'label' => 'Title',
            'attr' => array('placeholder' => 'Title')
            ))
            ->add('entityDescription'  , 'text', array(
                'label' => 'Description',
                'attr' => array('placeholder' => 'Description')
            ))
            ->add('entityStarttime', 'text', array(
                'label'         => 'Start Time',
                'required'      => false
            ))
            ->add('entityEndtime', 'text', array(
                'label'         => 'End Time',
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

