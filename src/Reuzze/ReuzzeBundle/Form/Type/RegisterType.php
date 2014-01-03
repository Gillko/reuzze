<?php

namespace Reuzze\ReuzzeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegisterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('person'     , new PersonType())
            ->add('username'   , 'text', array(
                'label' => 'Username',
                'attr' => array('placeholder' => 'Username')
            ))
            ->add('userEmail'       , 'email', array(
                'label' => 'Email',
                'attr' => array('placeholder' => 'E-mail address')
            ))
            ->add('password' , 'repeated', array(
                'type' => 'password',
                'first_name' => 'password',
                'second_name' => 'confirm',
                'first_options' => array(
                    'attr' => array('class' => 'form-control', 'placeholder' => 'Password'),
                    'label' => 'Password',
                ),
                'second_name'    => 'confirm',
                'second_options' => array(
                    'label' => 'Repeat Password',
                    'attr' => array('class' => 'form-control', 'placeholder' => 'Repeat Password'),
                ),
                'invalid_message' => 'The passwords are not identical!',
            )
        );
    }

    public function getName()
    {
        return 'register';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Reuzze\ReuzzeBundle\Entity\Users',
            'validation_groups' => array('registration'),
        ));
    }

}

