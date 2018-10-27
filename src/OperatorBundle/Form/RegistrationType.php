<?php

namespace OperatorBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'attr' => [
                    'placeholder' => 'email'
                ]
                ))
            ->add('username', null, array(
                'attr' => [
                    'placeholder' => 'username'
                ]
                ))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'options' => array(
                    'attr' => array(
                        'autocomplete' => 'new-password',
                    ),
                ),
                'first_options' => array(
                    'label' => 'Password',
                    'attr' => [
                        'placeholder' => 'password'
                    ]
                ),
                'second_options' => array(
                    'label' => 'Repeat password',
                    'attr' => [
                        'placeholder' => 'repeat password'
                    ]
                ),
                'invalid_message' => 'fos_user.password.mismatch',

            ))
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'name'
                ]
            ])
            ->add('lastName', TextType::class, [
                'attr' => [
                    'placeholder' => 'last name',
                ]
            ])
        ;

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OperatorBundle\Entity\Operator',
            'csrf_token_id' => 'registration',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'user';
    }



}
