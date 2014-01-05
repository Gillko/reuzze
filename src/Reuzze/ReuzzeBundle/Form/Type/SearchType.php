<?php

namespace Reuzze\ReuzzeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Doctrine\ORM\EntityManager;

class SearchType extends AbstractType
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('entityTitle'   , 'text', array(
                'label' => 'Title',
                'attr' => array('placeholder' => 'Title')
            ))
            ->add('category'     , new CategoryType($this->em))
            ->add('region'       , new RegionType())
        ;
    }

    public function getName()
    {
        return 'search';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Reuzze\ReuzzeBundle\Entity\Entities',
        ));
    }

}

