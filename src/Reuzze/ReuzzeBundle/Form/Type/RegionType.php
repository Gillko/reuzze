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

class RegionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*$builder->add('regionName'   , 'text', array(
            'label' => 'Region Name',
            'attr' => array('placeholder' => 'Region Name')
        ));*/

        $builder->add('regionName', 'entity', array(
            'class' => 'ReuzzeReuzzeBundle:Regions',
            'property' => 'regionName',
            'expanded' => false,
            'multiple' => false
        ));
    }

    public function getName()
    {
        return 'region';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Reuzze\ReuzzeBundle\Entity\Regions',
        ));
    }

}

