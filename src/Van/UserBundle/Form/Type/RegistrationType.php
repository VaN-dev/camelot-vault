<?php

namespace Van\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('username', null, [
            'label' => 'Username',
            'attr' => [
                'placeholder' => 'Username',
            ]
        ])
        ->add('email', 'repeated', [
            'type' => 'email',
            'invalid_message' => 'E-mails don\'t match.',
            'first_options'  => array(
                'label' => 'E-mail',
                'attr' => array(
                    'placeholder' => 'E-mail',
                    'class' => 'form-control',
                ),
            ),
            'second_options'  => array(
                'label' => 'Confirm e-mail',
                'attr' => array(
                    'placeholder' => 'Confirm e-mail',
                    'class' => 'form-control',
                ),
            ),
        ])
        ->add('plainPassword', 'repeated', [
            'type' => 'password',
            'invalid_message' => 'Passwords don\'t match.',
            'first_options'  => array(
                'label' => 'Password',
                'attr' => array(
                    'placeholder' => 'Password',
                    'class' => 'form-control',
                ),
            ),
            'second_options'  => array(
                'label' => 'Confirm password',
                'attr' => array(
                    'placeholder' => 'Confirm password',
                    'class' => 'form-control',
                ),
            ),
        ])
        ;
    }

    public function getName()
    {
        return 'van_userbundle_usertype';
    }
}
