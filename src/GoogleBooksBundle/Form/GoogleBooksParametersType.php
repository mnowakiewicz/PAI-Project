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
use GoogleBooksBundle\Options\Enum\OrderByEnum;
use GoogleBooksBundle\Options\Enum\PrintTypeEnum;
use GoogleBooksBundle\Options\Enum\ProjectionEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
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
                'label' => 'Query',
            ])
            ->add('maxResults', IntegerType::class, [
                'data' => 10
            ])
            ->add('startIndex', IntegerType::class, [
                'data' => 0
            ])
            ->add('filter', ChoiceType::class, [
                'choices' => [
                    '' => null,
                    FilterEnum::EBOOKS()->getValue() => FilterEnum::EBOOKS(),
                    FilterEnum::FREE_EBOOKS()->getValue() => FilterEnum::FREE_EBOOKS(),
                    FilterEnum::PAID_EBOOKS()->getValue() => FilterEnum::PAID_EBOOKS(),
                    FilterEnum::PARTIAL()->getValue() => FilterEnum::PARTIAL(),
                    FilterEnum::FULL()->getValue() => FilterEnum::FULL()
                ],
                'choices_as_values' => true,
                'choice_value' => function($choice){
                    return $choice;
                }
            ])
            ->add('langRestrict')
            ->add('libraryRestrict', ChoiceType::class, [
                'choices' => [
                    '' => null,
                    LibraryRestrictEnum::MY_LIBRARY()->getValue() => LibraryRestrictEnum::MY_LIBRARY(),
                    LibraryRestrictEnum::NO_RESTRICT()->getValue() => LibraryRestrictEnum::NO_RESTRICT()
                ],
                'choices_as_values' => true,
                'choice_value' => function($choice){
                return $choice;
                }
            ])
            ->add('orderBy', ChoiceType::class, [
                'choices' => [
                    '' => null,
                    OrderByEnum::RELEVANCE()->getValue() => OrderByEnum::RELEVANCE(),
                    OrderByEnum::NEWEST()->getValue() => OrderByEnum::NEWEST()
                ],
                'choices_as_values' => true,
                'choice_value' => function($choice){
                    return $choice;
                }
            ])
            ->add('partner')
            ->add('printType', ChoiceType::class, [
                'choices' => [
                    '' => null,
                    PrintTypeEnum::MAGAZINES()->getValue() => PrintTypeEnum::MAGAZINES(),
                    PrintTypeEnum::BOOKS()->getValue() => PrintTypeEnum::BOOKS()
                ],
                'choices_as_values' => true,
                'choice_value' => function($choice){
                    return $choice;
                }
            ])
            ->add('projection', ChoiceType::class, [
                'choices' => [
                    '' => null,
                    ProjectionEnum::FULL()->getValue() => ProjectionEnum::FULL(),
                    ProjectionEnum::LITE()->getValue() => ProjectionEnum::LITE()
                ],
                'choices_as_values' => true,
                'choice_value' => function($choice){
                    return $choice;
                }
            ])
            ->add('showPreorders', ChoiceType::class, [
                'choices' => [
                    ' ' => null,
                    'true' => 'true',
                    'false' => 'false'
                ],
                'choices_as_values' => true,
                'choice_value' => function($choice){
                    return $choice;
                }
            ])
            ->add('source');
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