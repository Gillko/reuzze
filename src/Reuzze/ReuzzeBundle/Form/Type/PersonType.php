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

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('address'     , new AddressType())
            ->add('personFirstname'   , 'text', array(
            'label' => 'Firstname',
            'attr' => array('placeholder' => 'Firstname')
        ))
            ->add('personSurname'  , 'text', array(
                'label' => 'Surname',
                'attr' => array('placeholder' => 'Surname')
            ))
        ;
    }

    public function getName()
    {
        return 'person';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Reuzze\ReuzzeBundle\Entity\Persons',
        ));
    }

}

