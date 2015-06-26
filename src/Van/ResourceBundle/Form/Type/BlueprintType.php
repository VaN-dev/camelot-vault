<?php

namespace Van\ResourceBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class BlueprintType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('file', 'file')
        ;
    }

    public function getName()
    {
        return 'appbundle_blueprinttype';
    }
}
