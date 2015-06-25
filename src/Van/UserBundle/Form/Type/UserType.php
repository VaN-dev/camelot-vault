<?php

namespace Van\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('email')
        ->add('plainPassword')
        ;
    }

    public function getName()
    {
        return 'van_userbundle_usertype';
    }
}
