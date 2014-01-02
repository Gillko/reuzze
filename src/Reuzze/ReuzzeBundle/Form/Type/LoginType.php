<?php

namespace Reuzze\ReuzzeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username'   , 'email', array(
                    'label' => 'Username',
                    'attr' => array('placeholder' => 'Username')
        ))
                ->add('password'   , 'password', array(
                    'label' => 'Password',
                    'attr' => array('placeholder' => 'Password')
        ));
    }

    public function getName()
    {
        return 'login';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Reuzze\ReuzzeBundle\Entity\Users',
            'validation_groups' => array('login'),
        ));
    }
}

