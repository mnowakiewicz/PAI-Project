<?php
/**
 * Created by PhpStorm.
 * User: programista
 * Date: 04.11.18
 * Time: 12:53
 */

namespace GoogleBooksBundle\Form;



use GoogleBooksBundle\Options\Enum\FilterEnum;
use GoogleBooksBundle\Options\Enum\LibraryRestrictEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GoogleBooksParametersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('q', TextType::class, [

            ])
            ->add('filter', ChoiceType::class, [
                'choices' => [
                    FilterEnum::EBOOKS()->getValue() => FilterEnum::EBOOKS(),
                    FilterEnum::FREE_EBOOKS()->getValue() => FilterEnum::FREE_EBOOKS(),
                    FilterEnum::PAID_EBOOKS()->getValue() => FilterEnum::PAID_EBOOKS(),
                    FilterEnum::PARTIAL()->getValue() => FilterEnum::PARTIAL()
                ]
            ])
            ->add('langRestrict')
            ->add('libraryRestrict', ChoiceType::class, [
                'choices' => [
                    LibraryRestrictEnum::MY_LIBRARY()->getValue() => LibraryRestrictEnum::MY_LIBRARY(),
                    LibraryRestrictEnum::NO_RESTRICT()->getValue() => LibraryRestrictEnum::NO_RESTRICT()
                ]
            ])
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