<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 04.11.18
 * Time: 12:53
 */

namespace GoogleBooksBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GoogleBooksParametersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('q')
            ->add('filter')
            ->add('langRestrict')
            ->add('libraryRestrict')
            ->add('maxResults')
            ->add('orderBy')
            ->add('partner')
            ->add('printType')
            ->add('projection')
            ->add('showPreorders')
            ->add('source')
            ->add('startIndex');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'GoogleBooksBundle\Options\GoogleBooksAPIRequestParameters'
        ]);
    }

    public function getBlockPrefix()
    {
        return 'googlebundle_parameters';
    }


}