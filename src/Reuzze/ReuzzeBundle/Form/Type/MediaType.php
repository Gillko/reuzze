<?php

namespace Reuzze\ReuzzeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('mediumUrl'  , 'file', array(
            'label' => 'Files',
            'attr' => array('id' => 'fileupload', 'name' => 'files[]')
        ))

        ;
    }

    public function getName()
    {
        return 'media';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Reuzze\ReuzzeBundle\Entity\Media',
        ));
    }

}

