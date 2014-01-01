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

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('region'     , new RegionType())
                ->add('addressStreet'   , 'text', array(
            'label' => 'Street Name',
            'attr' => array('placeholder' => 'Street Name')
        ))
            ->add('addressCity'  , 'text', array(
                'label' => 'City',
                'attr' => array('placeholder' => 'City')
            ))
            ->add('addressStreetnr'  , 'text', array(
                'label' => 'Street Number',
                'attr' => array('placeholder' => 'Street Number')
            ))
        ;
    }

    public function getName()
    {
        return 'address';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Reuzze\ReuzzeBundle\Entity\Addresses',
        ));
    }

}

