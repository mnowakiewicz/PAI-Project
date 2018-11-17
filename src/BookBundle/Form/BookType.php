<?php

namespace BookBundle\Form;

use AuthorBundle\Entity\Author;
use BookBundle\Entity\Book;
use BookBundle\Entity\Enum\StatusEnum;
use BookBundle\Entity\PrintType;
use CategoryBundle\Entity\Category;

use ImageBundle\Entity\Image;
use PublisherBundle\Entity\Publisher;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('subtitle', TextType::class)
            ->add('publishedDate', TextType::class)
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'editor-wysihtml5'
                ]
            ])
            ->add('pageCount', IntegerType::class)
            ->add('language', TextType::class)
            ->add('webReaderLink', UrlType::class)
            ->add('authors', EntityType::class, [
                'class' => Author::class,
            ])
            ->add('printType', EntityType::class, [
                'class' => PrintType::class,
                'choice_label' => 'name',
            ])
            ->add('categories', EntityType::class, [
                'class'  => Category::class
            ])
            ->add('publisher', EntityType::class, [
                'class' => Publisher::class
            ])
            ->add('image', EntityType::class, [
                'class' => Image::class
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    StatusEnum::DRAFT()->getValue() => StatusEnum::DRAFT(),
                    StatusEnum::PUBLISHED()->getValue() => StatusEnum::PUBLISHED()
                ]
            ]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BookBundle\Entity\Book',
            'required' => false,
            'validation_groups' => function (FormInterface $form) {

                /** @var Book $data */
                $data = $form->getData();

                if($data->getStatus() === StatusEnum::PUBLISHED()->getValue())
                    return ['published'];
            }
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bookbundle_book';
    }


}
